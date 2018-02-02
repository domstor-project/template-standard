<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Domstor\TemplateBundle\Model\TitleProviderInterface;
use Domstor_Builder;
use Domstor_Domstor;
use Symfony\Component\Config\FileLocatorInterface;
/**
 * @Route("/objects")
 */
class ObjectsController extends Controller
{
    /**
     * @param int    $location
     * @param string $object
     * @param string $action
     * @param string $id
     * @param Request $request
     * @Route("/{location}/{object}/{action}/{id}")
     * @Template()
     * @return array
     */
    public function detailAction($location, $object, $action, $id, Request $request) {
        /* @var $locator FileLocatorInterface */
        $locator = $this->container->get('file_locator');
        /* @var $builder Domstor_Builder */
        $builder = $this->get('domstor.template.domstorlib.domstor_builder');
        $baseParams = $this->getParameter('domstor.template.domstorlib.domstor_parameters');
        $domstor = $builder->build(array(
            'org_id' => $baseParams['org_id'],
            'location_id' => $location,
            'cache' => array(
                'type' => $baseParams['cache']['type'],
                'time' => $baseParams['cache']['time'],
                'uniq_key' => $baseParams['cache']['uniq_key'],
                'options' => array('directory' => $locator->locate($baseParams['cache']['options']['directory'])),
            ),
            'href_templates' => array(
                'object' =>  $this->generateUrl('app_objects_detail', array(
                        'location'=> $location,
                        'object' => $object,
                        'action' => $action,
                        'id' => '-id',
                    )).'?%sort%filter',
                'list' =>  $this->generateUrl('app_objects_list', array(
                        'location'=> $location,
                        'object' => $object,
                        'action' => $action,
                    )).'?page=%page%sort%filter',
            ),
            'href_placeholders' => array(
                'id' => '-id',
            ),
        ));
        $domstor->createFilter($object, $action);
        $domstor->getFilter()->bindFromRequest();

        $detail = $domstor->getDetail($object, $action, $id);
        if ($detail===null)
        {
            throw $this->createNotFoundException();
        }
        /* @var $titleProvider TitleProviderInterface */
        $titleProvider = $this->get('domstor.template.provider.title');
        return [
            'detail' => $detail,
            'object' => $object,
            'action' => $action,
            'list_url' => $domstor->getListLink($object, $action),
            'list_title' => $titleProvider->getListTitle($object, $action, $domstor->getLocationName('pr'))
        ];
    }

    /**
     * @param string $location
     * @param string $object
     * @param string $action
     * @param Request $request
     * @Route("/{location}/{object}/{action}")
     * @Template()
     * @return array
     */
    public function listAction($location, $object, $action, Request $request) {
        /* @var $locator \Symfony\Component\Config\FileLocatorInterface */
        $locator = $this->container->get('file_locator');
        /* @var $builder Domstor_Builder */
        $builder = $this->get('domstor.template.domstorlib.domstor_builder');
        $baseParams = $this->getParameter('domstor.template.domstorlib.domstor_parameters');
        $locationId = is_numeric($location) ? (int)$location : $baseParams['location_id'];
        $domstor = $builder->build(array(
            'org_id' => $baseParams['org_id'],
            'location_id' => $locationId,
            'cache' => array(
                'type' => $baseParams['cache']['type'],
                'time' => $baseParams['cache']['time'],
                'uniq_key' => $baseParams['cache']['uniq_key'],
                'options' => array('directory' => $locator->locate($baseParams['cache']['options']['directory'])),
            ),
            'filter' => array(
                'template_dir' => $locator->locate($baseParams['filter']['template_dir']),
            ),
            'href_templates' => array(
                'object' =>  $this->generateUrl('app_objects_detail', array(
                        'location' => $locationId,
                        'object' => $object,
                        'action' => $action,
                        'id' => '-id',
                    )).'?%sort%filter',
                'list' =>  $this->generateUrl('app_objects_list', array(
                        'location' => $locationId,
                        'object' => $object,
                        'action' => $action,
                    )).'?page=%page%sort%filter',

            ),
            'href_placeholders' => array(
                'id' => '-id',
            ),
        ));
        $locationList = $domstor->getLocationsList($object, $action);
        $page = $request->get('page', 1);
        $list = $domstor->getList($object, $action, $page);
        $domstor->savePageNumber($page);
        $list->addCssClass($object.'_'.$action);
        $list->deleteField('phone');
        $list->deleteField('phone_want');
        $list->deleteField('other_building');
        $list->deleteField('square_house');
        $list->deleteField('note_web');
        $list->deleteField('building_material');
        $list->deleteField('balcony');
        /* @var $titleProvider TitleProviderInterface */
        $titleProvider = $this->get('domstor.template.provider.title');
        return [
            'list' => $list,
            'locationsList' => $locationList,
            'title' => $titleProvider->getListTitle($object, $action, $domstor->getLocationName('pr')),
            'currentLocation'=>$locationId
        ];
    }
}