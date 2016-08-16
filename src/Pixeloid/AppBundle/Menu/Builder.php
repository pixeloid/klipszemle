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

  public function secondaryMenu(FactoryInterface $factory, array $options){

    $menu = $factory->createItem('root');
    $menu->setChildrenAttributes(array('class' => 'nav navbar-nav hidden-md hidden-sm hidden-xs'));
    // $menu->addChild('Nevezési Határidő 09.03.', array('route' => 'eventregistration_new', 'routeParameters' => array()));
//    $menu->addChild('Jelentkezés', array('route' => 'eventregistration_new', 'routeParameters' => array()))->setLinkAttribute('class', 'highlight');;

   // $menu->addChild('A nevezés lezárult!', array('uri' => '/#'))->setLinkAttribute('class', 'highlight animated page-scroll');

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
        $menu->addChild('Jelentkezés', array('route' => 'eventregistration_new', 'routeParameters' => array()))->setLinkAttribute('class', ' highlight');;
        $menu->addChild('Mi a klipszemle?', array('uri' => '/#about'))->setLinkAttribute('class', 'animated page-scroll hidden-sm');
        $menu->addChild('Zsűri & Szervezők', array('uri' => '/#jury'))->setLinkAttribute('class', 'animated page-scroll');
       // $menu->addChild('Program', array('uri' => '/#program'))->setLinkAttribute('class', 'animated page-scroll');
        $menu->addChild('Kapcsolat', array('uri' => '/#contact'))->setLinkAttribute('class', 'animated page-scroll');
        $menu->addChild('FAQ', array('uri' => '/#faq'))->setLinkAttribute('class', 'animated page-scroll');
        $menu->addChild(' ', array('uri' => 'https://facebook.com/klipszemle'))->setLinkAttribute('class', 'fa fa-facebook-official fb');



        return $menu;
  }
}