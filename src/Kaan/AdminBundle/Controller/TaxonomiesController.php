<?php

namespace Kaan\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Kaan\CoreBundle\Entity\Taxonomies;
use Kaan\AdminBundle\Form\TaxonomiesType;

class TaxonomiesController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $repo = $em->getRepository('CoreBundle:Taxonomies');
        $arrayTree = $repo->childrenHierarchy();
        return $this->render('AdminBundle:Taxonomies:index.html.twig', array(
                    'taxonomies' => $arrayTree,
                ));
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $t = $this->get('translator');

        $find = $em->getRepository('CoreBundle:Taxonomies')->find($id);
        if (!$find) {
            throw new NotFoundHttpException('Taxonomies Not Found!');
        }
        $em->remove($find);
        $em->flush();
        $this->get('session')->setFlash('alert', $t->trans('Removed'));
        return $this->redirect($this->generateUrl('taxonomies_homepage'));
    }

    public function createAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();

        $taxonomies = new Taxonomies();
        $form = $this->createForm(new TaxonomiesType(), $taxonomies);
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($taxonomies);
                $em->flush();
                return $this->redirect($this->generateUrl('taxonomies_homepage'));
            }
        }


        return $this->render('AdminBundle:Taxonomies:create.html.twig', array(
                    'form' => $form->createView(),
                ));
    }

    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();
        
        $find = $em->getRepository('CoreBundle:Taxonomies')->find($id);
        if (!$find) {
            throw new NotFoundHttpException('Taxonomies Not Found');
        }
        $form = $this->createForm(new TaxonomiesType, $find);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $em->persist($find);
                $em->flush();
                return $this->redirect($this->generateUrl('taxonomies_homepage'));
            }
        }

        return $this->render('AdminBundle:Taxonomies:update.html.twig', array(
                    'form' => $form->createView(),
                    'tax' => $find
                ));
    }

}
