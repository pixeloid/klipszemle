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
    $menu->removeChild('Login');
    $menu->removeChild('Logout');


    return $menu;

  }

  private function buildChildren($menu)
  {
        $menu->addChild('Nyitóoldal', array('route' => 'pixeloid_app_index', 'routeParameters' => array()));
        $menu->addChild('Térkép', array('route' => 'pixeloid_app_map', 'routeParameters' => array()));
        $menu->addChild('Általános információ', array('route' => 'pixeloid_app_info', 'routeParameters' => array()));
        $menu->addChild('Regisztráció a rendezvényre', array('route' => 'eventregistration_new', 'routeParameters' => array()));
        $menu->addChild('A rendezvény programja', array('route' => 'pixeloid_app_programme', 'routeParameters' => array()));
     //   $menu->addChild('Abstract submission', array('route' => 'presentation_new', 'routeParameters' => array('step' => 1)));

        // $securityContext = $this->container->get('security.context');

        // if ($securityContext->isGranted('ROLE_USER')) {
        //     // The current (may be switched) username.
        //     $username = $securityContext->getToken()->getUser()->getUsername();

        //     // The actual user, if switched, retrieve the correct one.
        //     $actualUser = $securityContext->getToken()->getUser();

        //     $menu->addChild('Logout', array('route' => 'fos_user_security_logout'));
        //     $menu->addChild('Profile', array('route' => 'fos_user_profile_show'));
        // }
        // else
        // {
        //     $menu->addChild('Login', array('route' => 'fos_user_security_login'));

        // }

        return $menu;
  }
}