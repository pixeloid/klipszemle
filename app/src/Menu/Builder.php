<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class Builder implements ContainerAwareInterface
{

    use ContainerAwareTrait;


    private FactoryInterface $factory;
    /**
     * @var AuthorizationCheckerInterface
     */
    private AuthorizationCheckerInterface $authorizationChecker;

    /**
     * Builder constructor.
     * @param FactoryInterface $factory
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(FactoryInterface $factory, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->factory = $factory;
        $this->authorizationChecker = $authorizationChecker;
    }


    public function createMainMenu(RequestStack $requestStack)
    {

        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(['class' => 'nav navbar-nav']);

        return $this->buildChildren($menu);
    }

    public function createSecondaryMenu(RequestStack $requestStack): ItemInterface
    {

        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(['class' => 'nav navbar-nav hidden-md hidden-sm hidden-xs']);
      // $menu->addChild('Nevezési Határidő 09.03.',
        // array('route' => 'eventregistration_new', 'routeParameters' => array()));
  //    $menu->addChild('Jelentkezés',
        // array('route' => 'eventregistration_new', 'routeParameters' => array()))
        //->setLinkAttribute('class', 'highlight');;

     // $menu->addChild('A nevezés lezárult!',
        // array('uri' => '/#'))->setLinkAttribute('class', 'highlight animated page-scroll');

        return $menu;
    }

    public function createTopMenu(RequestStack $requestStack): ItemInterface
    {

        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(['class' => 'nav navbar-nav']);



        if ($this->authorizationChecker->isGranted('ROLE_USER')) {
            // The current (may be switched) username.
            // $username = $securityContext->getToken()->getUser()->getUsername();

            // // The actual user, if switched, retrieve the correct one.
            // $actualUser = $securityContext->getToken()->getUser();

            $menu->addChild('Kilépés', ['route' => 'app_logout']);
            // $menu->addChild('Fiókom', array('route' => 'fos_user_profile_show'));
        } else {
           // $menu->addChild('Belépés', array('route' => 'fos_user_security_login'));
        }
        return $menu;
    }

    private function buildChildren($menu)
    {

        if ($this->authorizationChecker->isGranted('ROLE_JURY')) {
            //   $menu->addChild('Zsűri', array('route' => 'rate_index', 'routeParameters' => array()))
            //->setLinkAttribute('class', ' highlight');;
        }
        if ($this->authorizationChecker->isGranted('ROLE_USER')) {
           $menu->addChild('Profilom, nevezéseim', ['route' => 'app_profile']);
            $menu->addChild('Kijelentkezés', ['route' => 'app_logout']);
        } else {
            $menu->addChild('Belépés', ['route' => 'app_login']);
            $menu->addChild('Regisztráció', ['route' => 'app_register']);
        }

        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $menu->addChild('Toplista', array('route' => 'vote_vote_toplist'));
        }

        if ($this->authorizationChecker->isGranted('EVENTREGISTRATION_VOTE')) {
            $menu->addChild('Szavazás', array('route' => 'vote_index', 'routeParameters' => array()))
                ->setLinkAttribute('class', ' highlight');
            ;
        }
        
        if ($this->authorizationChecker->isGranted('EVENTREGISTRATION_CREATE')) {
            $menu->addChild('Nevezés', array('route' => 'eventregistration_new', 'routeParameters' => array()))
                ->setLinkAttribute('class', ' highlight');
            ;
        }
        $menu->addChild('Program', ['route' => 'program']);
        $menu->addChild('Shortlist', ['route' => 'news']);
        // $menu->addChild('Rólunk írták', array('uri' => '#'));
        // $menu->addChild('Cuccok', array('uri' => '#'));
        $menu->addChild('Faq', ['route' => 'faq']);
        // $menu->addChild('Facebook', array('uri' => 'https://facebook.com/klipszemle'))
        //->setLinkAttribute('class', 'fa fa-facebook-official fb')->setAttribute('icon', 'icon-class');;
        // $menu->addChild('Instagram', array('uri' => 'https://instagram.com/klipszemle'))
        //->setLinkAttribute('class', 'fa fa-instagram fb');



        return $menu;
    }
}
