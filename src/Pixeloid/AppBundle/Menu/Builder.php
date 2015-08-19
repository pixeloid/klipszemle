<?php

namespace Pixeloid\AppBundle\Menu;


use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {

        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(array('class' => 'nav navbar-nav'));

        $menu = $this->buildChildren($menu);


        return $menu;
  }

  public function homepageMenu(FactoryInterface $factory, array $options){

    $menu = $factory->createItem('root');
    $menu->setChildrenAttributes(array('class' => 'nav-stacked homepage-menu'));
    $menu = $this->buildChildren($menu);
    $menu->removeChild('Home');


    return $menu;

  }

  public function topMenu(FactoryInterface $factory, array $options){

    $menu = $factory->createItem('root');
    $menu->setChildrenAttributes(array('class' => 'nav navbar-nav'));


    $securityContext = $this->container->get('security.context');

    if ($securityContext->isGranted('ROLE_USER')) {
        // The current (may be switched) username.
        $username = $securityContext->getToken()->getUser()->getUsername();

        // The actual user, if switched, retrieve the correct one.
        $actualUser = $securityContext->getToken()->getUser();

        $menu->addChild('Kilépés', array('route' => 'fos_user_security_logout'));
        // $menu->addChild('Fiókom', array('route' => 'fos_user_profile_show'));

        if ($securityContext->isGranted('ROLE_ADMIN')) {
          $menu->addChild('Regisztrációk listája', array('route' => 'eventregistration'));
        }
    }
    else
    {
       // $menu->addChild('Belépés', array('route' => 'fos_user_security_login'));

    }
    return $menu;

  }

  private function buildChildren($menu)
  {
        $menu->addChild('Mi a klipszemle?', array('uri' => '/#about'))->setLinkAttribute('class', 'animated page-scroll');
        $menu->addChild('Szervezők & Zsűri', array('uri' => '/#jury'))->setLinkAttribute('class', 'animated page-scroll');
        $menu->addChild('Jelentkezés', array('route' => 'eventregistration_new', 'routeParameters' => array()));
        // $menu->addChild('Program', array('route' => 'pixeloid_app_info', 'routeParameters' => array()));
        $menu->addChild('Kapcsolat', array('uri' => '/#contact'))->setLinkAttribute('class', 'animated page-scroll');
        $menu->addChild('FAQ', array('uri' => '/#faq'))->setLinkAttribute('class', 'animated page-scroll');



        return $menu;
  }
}