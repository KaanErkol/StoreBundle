<?php

namespace Kaan\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Kaan\CoreBundle\Entity\Product;
use Kaan\AdminBundle\Form\ProductType;

class ProductController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $products = $em->getRepository('CoreBundle:Product')->findAll();

        return $this->render('AdminBundle:Product:index.html.twig', array(
                    'products' => $products,
                ));
    }

    public function createAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $product = new Product();
        $form = $this->createForm(new ProductType(), $product);
        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                foreach ($product->getAttribute() as $test) {
                    $test->setProduct($product);
                    $em->persist($test);
                }

                $em->persist($product);
                $em->flush();
                foreach ($request->request->get('taxonomies') as $tax) {
                    $taxonomi = $em->getRepository('CoreBundle:Taxonomies')->find($tax);
                    $product->addTaxonomies($taxonomi);
                    $em->persist($product);
                    $em->flush();
                    
                    return $this->redirect($this->generateUrl('product_show',array('id'=> $product->getId())));
                }
            }
        }


        $taxonomies = $em->getRepository('CoreBundle:Taxonomies')->createQueryBuilder('t')
                        ->orderBy('t.root', 'ASC')
                        ->where('t.lvl = 0 ')
                        ->addOrderBy('t.lft', 'ASC')
                        ->getQuery()->getResult()
        ;

        return $this->render('AdminBundle:Product:create.html.twig', array(
                    'form' => $form->createView(),
                    'taxonomies' => $taxonomies,
                ));
    }

    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $product = $em->getRepository('CoreBundle:Product')->find($id);
        
        if(! $product){
            throw $this->createNotFoundException('Not Found');
        }

        $originalTaxonomies = array();
        $originalOption = array();

        foreach ($product->getTaxonomies() as $row) {
            $originalTaxonomies[] = $row;
        }
        
        foreach ($product->getOptions() as $row) {
            $originalOption[] = $row;
        }

        $form = $this->createForm(new ProductType(), $product);
        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                foreach ($product->getAttribute() as $test) {
                    $test->setProduct($product);
                    $em->persist($test);
                }

                foreach ($product->getOptions() as $row) {
                    foreach ($originalOption as $key => $toDel) {
                        if ($toDel->getId() === $row->getId()) {
                            unset($originalOption[$key]);
                        }
                    }
                }
                
                
                foreach ($originalOption as $row) {

                    $em->remove($row);
                }
                         
                $post = $request->request->get('taxonomies');

                $del = array();
                foreach($originalTaxonomies as $tax){
                    $del[] = $tax->getId();
                }
                foreach($post as $key => $val){
                    if(($key = array_search($val, $del)) !== false) {
                        unset($del[$key]);
                    }
                }
                foreach($product->getTaxonomies() as $row){
                    foreach($post as $key => $value){
                        if($row->getId() == $value){
                            unset($post[$key]);
                        }
                    }
                }   

                foreach ($post as $tax) {
                    $taxonomi = $em->getRepository('CoreBundle:Taxonomies')->find($tax);
                    $product->addTaxonomies($taxonomi);
                    $em->persist($product);

                }
                foreach ($del as $d){
                    $taxonomi = $em->getRepository('CoreBundle:Taxonomies')->find($d);
                    $product->removeTaxonomies($taxonomi);
                    $em->persist($product);
  
                }


                foreach ($originalOption as $row) {
                    $em->remove($row);
                }                
                
                
                $em->persist($product);
                $em->flush();
                
            }
        }


        $taxonomies = $em->getRepository('CoreBundle:Taxonomies')->createQueryBuilder('t')
                        ->orderBy('t.root', 'ASC')
                        ->where('t.lvl = 0 ')
                        ->addOrderBy('t.lft', 'ASC')
                        ->getQuery()->getResult()
        ;

        return $this->render('AdminBundle:Product:edit.html.twig', array(
                    'form' => $form->createView(),
                    'taxonomies' => $taxonomies,
                    'entity' => $product,
                    'delete_form' => $this->createDeleteForm($product->getId())->createView(),
                ));
    }
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    public function deleteAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
        $find = $em->getRepository('CoreBundle:Product')->find($id);
        if(! $find){
            throw $this->createNotFoundException('Product Not Found');
        }
        $em->remove($find);
        $em->flush();
        return $this->redirect($this->generateUrl('product'));
        }
    }
    
    public function showAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        return new Response('test');
    }
}

?>
