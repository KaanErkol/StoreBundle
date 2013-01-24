<?php

namespace Kaan\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Mopa\Bundle\BootstrapBundle\Navbar\AbstractNavbarMenuBuilder;

class NavbarMenuBuilder extends AbstractNavbarMenuBuilder {

    protected $securityContext;
    protected $isLoggedIn;

    public function __construct(FactoryInterface $factory, SecurityContextInterface $securityContext) {
        parent::__construct($factory);

        $this->securityContext = $securityContext;
        $this->isLoggedIn = $this->securityContext->isGranted('IS_AUTHENTICATED_FULLY');
    }

    public function createMainMenu(Request $request) {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav');
        $item = $menu->addChild('Home', array('route' => 'admin_homepage'));
        $Category = $this->createDropdownMenuItem($menu, ' Category', false , array('icon' => 'caret'));
        $Category->addChild('Create Category', array(
            'route' => 'taxonomies_create',
            'icons' => 'caret'
            ));
        $Category->addChild('List Category', array('route' => 'taxonomies_homepage'));

        $assortment = $this->createDropdownMenuItem($menu, 'Assortment');
        $assortment->addChild('Products', array('route' => 'product'));
        $this->addDivider($assortment);
        $assortment->addChild('Manage Option', array('route' => 'option'));

        $user = $this->createDropdownMenuItem($menu, 'User');
        $user->addChild('Create User', array('route' => 'user_create'));
        $user->addChild('User List', array('route' => 'user_homepage'));

        $config = $this->createDropdownMenuItem($menu, 'Configuration');

        $config->addChild('Taxation Category', array('route' => 'taxation'));
        $config->addChild('Taxation Rate', array('route' => 'taxationrate_homepage'));
        $this->addDivider($config);
        $config->addChild('Zones', array('route' => 'zone_homepage'));
        $this->addDivider($config);
        $config->addChild('Shipping Category', array('route' => 'shippingcategory'));
        $this->addDivider($config);
        $config->addChild('Attribute List', array('route' => 'attribute'));


        return $menu;
    }

    public function createRightSideDropdownMenu(Request $request) {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav pull-right');

        if ($this->isLoggedIn) {
            $menu->addChild('Logout', array('route' => '_security_logout'));
        } else {
            $menu->addChild('Login', array('route' => '_security_login'));
            $menu->addChild('Register', array('route' => '_security_register'));
        }

        return $menu;
    }

}