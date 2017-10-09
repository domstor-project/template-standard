<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Domstor\TemplateBundle\Model\PostProviderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Description of NewsController
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 * @Route("/news")
 */
class NewsController extends Controller
{
    /**
     * @Route("")
     * @Template()
     */
    public function listAction(Request $request)
    {
        $page = $request->query->getAlnum('page', 1);
        $limit = 12;
        /* @var $repo PostProviderInterface */
        $repo = $this->get('app.repository.post');
        $pagination = $repo->findForListPage($page, $limit);
        return [
           'pagination'=>$pagination
        ];
    }    
    
    /**
     * @Route("/show/{post}")
     * @ParamConverter("post", class="AppBundle:Post", options={"repository_method" = "findForShowPage"})
     * @Template()
     */
    public function showAction(Request $request, Post $post)
    {
        return [
           'post'=>$post
        ];
    }
    
}
