<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Description of DefaultController
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class HomeController extends Controller
{
    /**
     * @Route("")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        return [];
    }
}
