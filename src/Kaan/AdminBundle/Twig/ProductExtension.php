<?php

namespace Kaan\AdminBundle\Twig;

class ProductExtension extends \Twig_Extension {

    /**
     * {@inheritdoc}
     */
    public function getFilters() {
        return array(
            'stok' => new \Twig_Filter_Method($this, 'stok'),
        );
    }

    public function stok($stok) {
        if($stok > 5){
            return '<span class="label">'.$stok.'</span>';
        }elseif($stok > 3){
            return '<span class="label label-warning">'.$stok.'</span>';
        }elseif($stok == 0 && $stok == 1){
            return '<span class="label label-important">'.$stok.'</span>';
        }else{
            return '<span class="label label-important">'.$stok.'</span>';
        }
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName() {
        return 'your_extension';
    }

}