<?php

namespace Pixeloid\AppBundle\Menu;


use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\RequestStack;

class Builder implements ContainerAwareInterface
{

  use ContainerAwareTrait;


  private $factory;

  public function __construct(FactoryInterface $factory)
  {
      $this->factory = $factory;
  }


    public function mainMenu(RequestStack $requestStack)
    {

        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(array('class' => 'nav navbar-nav'));

        $menu = $this->buildChildren($menu);


        return $menu;
  }

  public function secondaryMenu(RequestStack $requestStack){

    $menu = $this->factory->createItem('root');
    $menu->setChildrenAttributes(array('class' => 'nav navbar-nav hidden-md hidden-sm hidden-xs'));
    // $menu->addChild('Nevezési Határidő 09.03.', array('route' => 'eventregistration_new', 'routeParameters' => array()));
//    $menu->addChild('Jelentkezés', array('route' => 'eventregistration_new', 'routeParameters' => array()))->setLinkAttribute('class', 'highlight');;

   // $menu->addChild('A nevezés lezárult!', array('uri' => '/#'))->setLinkAttribute('class', 'highlight animated page-scroll');

    return $menu;

  }

  public function topMenu(RequestStack $requestStack){

    $menu = $this->factory->createItem('root');
    $menu->setChildrenAttributes(array('class' => 'nav navbar-nav'));



    if ($this->container->get('security.authorization_checker')->isGranted('ROLE_USER')) {
        // The current (may be switched) username.
        // $username = $securityContext->getToken()->getUser()->getUsername();

        // // The actual user, if switched, retrieve the correct one.
        // $actualUser = $securityContext->getToken()->getUser();

        $menu->addChild('Kilépés', array('route' => 'fos_user_security_logout'));
        // $menu->addChild('Fiókom', array('route' => 'fos_user_profile_show'));

        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
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

    if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
      $menu->addChild('Shortlist', array('route' => 'shortlist_index', 'routeParameters' => array()))->setLinkAttribute('class', ' highlight');;
    }

       // $menu->addChild('Szavazás', array('route' => 'vote', 'routeParameters' => array()))->setLinkAttribute('class', ' highlight');;
        // $menu->addChild('Jelentkezés', array('route' => 'eventregistration_new', 'routeParameters' => array()))->setLinkAttribute('class', ' highlight');;
        $menu->addChild('Mi a klipszemle?', array('uri' => '/#about'))->setLinkAttribute('class', 'animated page-scroll hidden-sm');
        $menu->addChild('Zsűri & Szervezők', array('uri' => '/#jury'))->setLinkAttribute('class', 'animated page-scroll');
        $menu->addChild('Program', array('uri' => '/#program'))->setLinkAttribute('class', 'animated page-scroll');
        $menu->addChild('Kapcsolat', array('uri' => '/#contact'))->setLinkAttribute('class', 'animated page-scroll');
        $menu->addChild('FAQ', array('uri' => '/#faq'))->setLinkAttribute('class', 'animated page-scroll');
        $menu->addChild(' ', array('uri' => 'https://facebook.com/klipszemle'))->setLinkAttribute('class', 'fa fa-facebook-official fb');



        return $menu;
  }
}