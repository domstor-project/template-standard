<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of Builder
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class Builder implements ContainerAwareInterface
{
    protected $container;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $root = $factory->createItem('root');
        //$request = $this->container->get('request_stack')->getCurrentRequest();
        //$routeName = $request->get('_route');
        //if($routeName != 'app_default_index') $root->addChild('Главная', array('route' => 'app_default_index'));
        $default = $root->addChild('Главная', array('route' => 'app_home_index'));
        $company = $root->addChild('О компании', array('route' => 'app_static_about'));
        $news = $root->addChild('Новости', array('route' => 'app_news_list'));
        $reviews = $root->addChild('Отзывы', array('route' => 'app_reviews_list'));
        $vacancies = $root->addChild('Вакансии', array('route' => 'app_vacancies_list'));
        $contact = $root->addChild('Контакты', array('route' => 'app_static_contact'));
        $req = $root->addChild('Подать заявку', array('uri' => '#'));
        $req
            ->setAttribute('id', 'btnOpenRequestModal')
        ;
        //$root->addChild('Партнёры', array('route' => 'app_partners_index'));
        //$root->addChild('Контакты', array('route' => 'app_contacts_index'));

        return $root;
    }
    
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
