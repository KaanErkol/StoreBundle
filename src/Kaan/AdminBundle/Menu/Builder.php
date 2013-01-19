<?php

namespace Kaan\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware {

    public function topNavbar(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');

        $item = $menu->addChild('Home', array('route' => 'admin_homepage'));
        $Category = $menu->addChild('Category');
        $Category->addChild('Create Category',array('route' => 'taxonomies_create'));
        $Category->addChild('List Category',array('route' => 'taxonomies_homepage'));
       
        $config = $menu->addChild('Configuration');
        
        $config->addChild('Taxation Category',array('route' => 'taxation'));
        $config->addChild('d1', array('attributes' => array('divider' => true)));
        $config->addChild('Zones',array('route'=> 'zone_homepage'));
        $config->addChild('d2', array('attributes' => array('divider' => true)));
        $config->addChild('Shipping Category',array('route' => 'shippingcategory'));
        
        return $menu;
    }

}