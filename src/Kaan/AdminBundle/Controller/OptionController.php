<?php

namespace Kaan\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Kaan\CoreBundle\Entity\Option;
use Kaan\CoreBundle\Entity\OptionValue;
use Kaan\AdminBundle\Form\OptionType;

/**
 * Option controller.
 *
 */
class OptionController extends Controller {

    /**
     * Lists all Option entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CoreBundle:Option')->findAll();

        return $this->render('AdminBundle:Option:index.html.twig', array(
                    'entities' => $entities,
                ));
    }

    /**
     * Finds and displays a Option entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Option')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Option entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Option:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to create a new Option entity.
     *
     */
    public function newAction() {
        $entity = new Option();
        $form = $this->createForm(new OptionType(), $entity);

        return $this->render('AdminBundle:Option:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    /**
     * Creates a new Option entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Option();
        $form = $this->createForm(new OptionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            foreach ($entity->getChild() as $test) {
                $test->setOption($entity);
                $em->persist($test);
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('option_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:Option:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                ));
    }

    /**
     * Displays a form to edit an existing Option entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Option')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Option entity.');
        }

        $editForm = $this->createForm(new OptionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Option:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Edits an existing Option entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Option')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Option entity.');
        }

        $originalOption = array();

        foreach ($entity->getChild() as $row) {
            $originalOption[] = $row;
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new OptionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {

            foreach ($entity->getChild() as $row) {
                foreach ($originalOption as $key => $toDel) {
                    if ($toDel->getId() === $row->getId()) {
                        unset($originalOption[$key]);
                    }
                }
            }

            foreach ($originalOption as $row) {

                $em->remove($row);
            }
            foreach ($entity->getChild() as $test) {
                $test->setOption($entity);
                $em->persist($test);
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('option_edit', array('id' => $id)));
        }

        return $this->render('AdminBundle:Option:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
    }

    /**
     * Deletes a Option entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CoreBundle:Option')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Option entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('option'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
