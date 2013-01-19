<?php

namespace Kaan\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kaan\CoreBundle\Entity\Taxation;
use Kaan\AdminBundle\Form\TaxationType;

/**
 * Taxation controller.
 *
 */
class TaxationController extends Controller
{
    /**
     * Lists all Taxation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CoreBundle:Taxation')->findAll();

        return $this->render('AdminBundle:Taxation:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Taxation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Taxation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Taxation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Taxation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Taxation entity.
     *
     */
    public function newAction()
    {
        $entity = new Taxation();
        $form   = $this->createForm(new TaxationType(), $entity);

        return $this->render('AdminBundle:Taxation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Taxation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Taxation();
        $form = $this->createForm(new TaxationType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('taxation_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:Taxation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Taxation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Taxation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Taxation entity.');
        }

        $editForm = $this->createForm(new TaxationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Taxation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Taxation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Taxation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Taxation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TaxationType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('taxation_edit', array('id' => $id)));
        }

        return $this->render('AdminBundle:Taxation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Taxation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CoreBundle:Taxation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Taxation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('taxation'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
