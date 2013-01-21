<?php

namespace Kaan\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Kaan\CoreBundle\Entity\TaxationRate;
use Kaan\AdminBundle\Form\TaxationRateType;

class TaxationRateController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $taxationRates = $em->getRepository('CoreBundle:TaxationRate')->findAll();

        return $this->render('AdminBundle:TaxationRate:index.html.twig', array(
                    'taxationRates' => $taxationRates,
                ));
    }

    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $taxationRate = $em->getRepository('CoreBundle:TaxationRate')->find($id);

        return $this->render('AdminBundle:TaxationRate:show.html.twig', array(
                    'entity' => $taxationRate,
                    'delete_form' => $this->createDeleteForm($taxationRate->getId())->createView(),
                ));
    }

    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $taxationRate = $em->getRepository('CoreBundle:TaxationRate')->find($id);
        if(! $taxationRate){
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Not Found TaxationRate');
        }
        $form = $this->createForm(new TaxationRateType(), $taxationRate);
        $request = $this->getRequest();

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($taxationRate);
                $em->flush();
                return $this->redirect($this->generateUrl('taxationrate_update',array('id'=>$taxationRate->getId())));
            }
        }
        return $this->render('AdminBundle:TaxationRate:update.html.twig', array(
                    'edit_form' => $form->createView(),
                    'entity' => $taxationRate,
                    'delete_form' => $this->createDeleteForm($taxationRate->getId())->createView(),
                ));
    }

    public function createAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $taxationRate = new TaxationRate();
        $request = $this->getRequest();
        $form = $this->createForm(new TaxationRateType(), $taxationRate);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($taxationRate);
                $em->flush();
                return $this->redirect($this->generateUrl('taxationrate_homepage'));
            }
        }

        return $this->render('AdminBundle:TaxationRate:create.html.twig', array(
                    'form' => $form->createView(),
                ));
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $find = $em->getRepository('CoreBundle:TaxationRate')->find($id);
        if(! $find){
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Not Found');
        }
        $em->remove($find);
        $em->flush();
        return $this->redirect($this->generateUrl('taxationrate_homepage'));
    }

        private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }
    

}

?>
