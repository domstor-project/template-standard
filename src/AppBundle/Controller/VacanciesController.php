<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Domstor\TemplateBundle\Model\VacancyProviderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Vacancy;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Description of VacanciesController
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 * @Route("/vacancies")
 */
class VacanciesController extends Controller
{
    /**
     * @Route("")
     * @Template()
     */
    public function listAction(Request $request)
    {
        $page = $request->query->getAlnum('page', 1);
        $limit = $this->getParameter('knp_paginator.page_range');
        /* @var $repo VacancyProviderInterface */
        $repo = $this->get('app.repository.vacancy');
        $pagination = $repo->findForListPage($page, $limit);
        return [
         'pagination'=>$pagination
        ];
    } 
    
    /**
     * @Route("/show/{vacancy}")
     * @ParamConverter("vacancy", class="AppBundle:Vacancy", options={"repository_method" = "findForShowPage"})
     * @Template()
     */
    public function showAction(Request $request, Vacancy $vacancy)
    {
        return [
           'vacancy'=>$vacancy
        ];
    }
}
