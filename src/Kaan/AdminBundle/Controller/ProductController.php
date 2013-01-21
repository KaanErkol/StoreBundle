<?php
namespace Kaan\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Kaan\CoreBundle\Entity\Product;
use Kaan\AdminBundle\Form\ProductType;

class ProductController extends Controller{
    public function indexAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $products = $em->getRepository('CoreBundle:Product')->findAll();
        
        return $this->render('AdminBundle:Product:index.html.twig',array(
            'products' => $products,
        ));
    }
    
    public function createAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $product = new Product();
        $form = $this->createForm(new ProductType(), $product);
        
        return $this->render('AdminBundle:Product:create.html.twig',array(
            'form' => $form->createView(),
        ));
    }
}

?>
