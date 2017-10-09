<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Domstor\TemplateBundle\Model\ReviewProviderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Review;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Description of ReviewsController
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 * @Route("/reviews")
 */
class ReviewsController extends Controller
{
    /**
     * @Route("")
     * @Template()
     */
    public function listAction(Request $request)
    {
        $page = $request->query->getAlnum('page', 1);
        $limit = 12;
        /* @var $repo ReviewProviderInterface */
        $repo = $this->get('app.repository.review');
        $pagination = $repo->findForListPage($page, $limit);
        return [
         'pagination'=>$pagination
        ];
    } 
    
    /**
     * @Route("/show/{review}")
     * @ParamConverter("review", class="AppBundle:Review", options={"repository_method" = "findForShowPage"})
     * @Template()
     */
    public function showAction(Request $request, Review $review)
    {
        return [
           'review'=>$review
        ];
    }
}
