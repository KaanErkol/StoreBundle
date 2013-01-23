<?php

namespace Kaan\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Kaan\CoreBundle\Entity\Product;
use Kaan\AdminBundle\Form\ProductType;
use Kaan\AdminBundle\Form\ProductVariantType;

class ProductController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $request = $this->getRequest();
        $paginator = $this->get('knp_paginator');
        $query = $em->createQueryBuilder()
                ->select('p')
                ->from('CoreBundle:Product', 'p')
                ->where('p.type = 0')
        ;
        $products = $paginator->paginate(
                $query->getQuery(), $this->get('request')->query->get('page', 1)/* page number */, 50/* limit per page */
        );

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
                foreach ($request->request->get('taxonomies') as $tax) {
                    $taxonomi = $em->getRepository('CoreBundle:Taxonomies')->find($tax);
                    $product->addTaxonomies($taxonomi);

                    $em->persist($product);
                }
                $product->setType(0);

                $em->persist($product);
                $em->flush();


                return $this->redirect($this->generateUrl('product_show', array('id' => $product->getId())));
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

        if (!$product) {
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
                foreach ($originalTaxonomies as $tax) {
                    $del[] = $tax->getId();
                }
                foreach ($post as $key => $val) {
                    if (($key = array_search($val, $del)) !== false) {
                        unset($del[$key]);
                    }
                }
                foreach ($product->getTaxonomies() as $row) {
                    foreach ($post as $key => $value) {
                        if ($row->getId() == $value) {
                            unset($post[$key]);
                        }
                    }
                }

                foreach ($post as $tax) {
                    $taxonomi = $em->getRepository('CoreBundle:Taxonomies')->find($tax);
                    $product->addTaxonomies($taxonomi);
                    $em->persist($product);
                }
                foreach ($del as $d) {
                    $taxonomi = $em->getRepository('CoreBundle:Taxonomies')->find($d);
                    $product->removeTaxonomies($taxonomi);
                    $em->persist($product);
                }


                foreach ($originalOption as $row) {
                    $em->remove($row);
                }

                $em->persist($product);
                $em->flush();
                return $this->redirect($this->generateUrl('product_show',array('id'=>$product->getId())));
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

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $find = $em->getRepository('CoreBundle:Product')->find($id);
            if (!$find) {
                throw $this->createNotFoundException('Product Not Found');
            }
            $em->remove($find);
            $em->flush();
            return $this->redirect($this->generateUrl('product'));
        }
    }

    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $requrest = $this->getRequest();

        $entity = $em->getRepository('CoreBundle:Product')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Product Not Found');
        }

        return $this->render('AdminBundle:Product:show.html.twig', array(
                    'entity' => $entity,
                ));
    }

    public function generateVariantAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();
        $product = $em->getRepository('CoreBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Product Not Found');
        }
        $array = array();
        $option = array();

        foreach ($product->getOptions() as $key => $value) {
            foreach ($value->getChild() as $optionval) {
                $array[$key][] = $optionval->getId();
                $option[$optionval->getId()] = $optionval;
            }
        }

        $permutations = $this->getPermutations($array);
        count($permutations);
        foreach ($permutations as $i => $permutation) {
            $new = new Product();
            $new->setParentProduct($product);
            $new->setAvaibleOn(new \DateTime('now'));
            $new->setAvaible(1);
            $new->setPrice($product->getPrice());
            $new->setStock(0);
            $new->setType(1);


            if (is_array($permutation)) {
                foreach ($permutation as $id) {
                    $new->addVariantOption($option[$id]);
                }
            } else {
                $new->addVariantOption($option[$permutation]);
            }
            $em->persist($new);
            $em->flush();
            unset($new);
        }



        return $this->redirect($this->generateUrl('product_show', array('id' => $product->getId())));
    }

    public function getPermutations($array, $recursing = false) {
        $countArrays = count($array);

        if (1 === $countArrays) {
            return reset($array);
        } elseif (0 === $countArrays) {
            throw new \InvalidArgumentException('At least one array is required');
        }

        $keys = array_keys($array);

        $a = array_shift($array);
        $k = array_shift($keys);

        $b = $this->getPermutations($array, true);

        $result = array();

        foreach ($a as $valueA) {
            if ($valueA) {
                foreach ($b as $valueB) {
                    if ($recursing) {
                        $result[] = array_merge(array($valueA), (array) $valueB);
                    } else {
                        $result[] = array($k => $valueA) + array_combine($keys, (array) $valueB);
                    }
                }
            }
        }

        return $result;
    }
    
    public function variantShowAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $product = $em->getRepository('CoreBundle:Product')->find($id);
        $newproduct = new Product();
        $request = $this->getRequest();
        if(! $product){
            throw $this->createNotFoundException('Product Not Found');
        }
        $form = $this->createForm(new ProductVariantType(), $product);
        
        $originalOption = array();

        foreach ($product->getChildren() as $row) {
            $originalOption[] = $row;
        }

        
        if($request->isMethod('POST')){
            $form->bind($request);
            if($form->isValid()){

                foreach ($product->getChildren() as $row) {
                    foreach ($originalOption as $key => $toDel) {
                        if ($toDel->getId() === $row->getId()) {
                            unset($originalOption[$key]);
                        }
                    }
                }
                
                foreach ($originalOption as $test){
                    $em->remove($test);
                }

                foreach ($product->getChildren() as $test) {
                    $test->setParentProduct($product);
                    
                    $em->persist($test);
                }

                $em->persist($product);
                $em->flush();
                return $this->redirect($this->generateUrl('product_show',array('id' =>$product->getId())));

            }
        }
        
        
        return $this->render('AdminBundle:Product:variantshow.html.twig',array(
            'form' => $form->createView(),
            'product' => $product,
        ));
    }
    
    public function variantdeleteAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $find = $em->getRepository('CoreBundle:Product')->find($id);
        if(! $find){
            throw $this->createNotFoundException('Product Not Found!');
        }
        $parentid = $find->getParentProduct()->getId();
        $em->remove($find);
        $em->flush();
        return $this->redirect($this->generateUrl('product_show',array('id' => $parentid)));
    }
    
    public function VariantValueAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $product = $em->getRepository('CoreBundle:Product')->find($id);
        $parentProduct = $product->getParentProduct();
        $response = '<ul>';
        foreach($product->getVariantOptions() as $vo){
            $response .= '<li><strong>'.$vo->getOption().'</strong>:'.$vo->getValue().'</li>';
        }
        $response .= '</ul>';
        return new Response($response);
        
    }

}

?>
