<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Domstor\TemplateBundle\Model\TitleProviderInterface;
use Domstor_Builder;
use Domstor_Domstor;

/**
 * @Route("/objects")
 */
class ObjectsController extends Controller
{    
    /**
     * @Route("/{object}/{action}/{id}")
     * @Template()
     */
    public function detailAction($object, $action, $id) {
        /* @var $locator \Symfony\Component\Config\FileLocatorInterface */
        $locator = $this->container->get('file_locator');
        /* @var $builder Domstor_Builder */
        $builder = $this->get('domstor.template.domstorlib.domstor_builder');
        $baseParams = $this->getParameter('domstor.template.domstorlib.domstor_parameters');
        $domstor = $builder->build(array(
            'org_id' => $baseParams['org_id'],
            'location_id' => $baseParams['location_id'],
            'cache' => array(
                'type' => $baseParams['cache_type'],
                'time' => $baseParams['cache_time'],
                'uniq_key' => (string)$baseParams['org_id'],
                'options' => array('directory' => $locator->locate($baseParams['cache_dir'])),
            ),
            'href_templates' => array(
                'object' =>  $this->generateUrl('app_objects_detail', array(
                    'object' => $object,
                    'action' => $action,
                    'id' => '-id',
                )).'?%sort%filter',
                'list' =>  $this->generateUrl('app_objects_list', array(
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
        return array(
            'detail' => $detail,
            'object' => $object,
            'action' => $action,
            'list_url' => $domstor->getListLink($object, $action),
            'list_title' => $titleProvider->getListTitle($object, $action, $domstor->getLocationName('pr')),
        );
    }
    
    /**
     * @Route("/{object}/{action}")
     * @Template()
     */
    public function listAction($object, $action, Request $request) {
        /* @var $locator \Symfony\Component\Config\FileLocatorInterface */
        $locator = $this->container->get('file_locator');
        /* @var $builder Domstor_Builder */
        $builder = $this->get('domstor.template.domstorlib.domstor_builder');
        $baseParams = $this->getParameter('domstor.template.domstorlib.domstor_parameters');
        $domstor = $builder->build(array(
            'org_id' => $baseParams['org_id'],
            'location_id' => $baseParams['location_id'],
            'cache' => array(
                'type' => $baseParams['cache_type'],
                'time' => $baseParams['cache_time'],
                'uniq_key' => (string)$baseParams['org_id'],
                'options' => array('directory' => $locator->locate($baseParams['cache_dir'])),
            ),
            'filter' => array(
                'template_dir' => $locator->locate($baseParams['filter_template_dir']),
            ),
            'href_templates' => array(
                'object' =>  $this->generateUrl('app_objects_detail', array(
                    'object' => $object,
                    'action' => $action,
                    'id' => '-id',
                )).'?%sort%filter',
                'list' =>  $this->generateUrl('app_objects_list', array(
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
        ];
    }
    
}
