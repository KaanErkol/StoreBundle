<?php

namespace Kaan\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kaan\CoreBundle\Entity\ShippingCategory;
use Kaan\AdminBundle\Form\ShippingCategoryType;

/**
 * ShippingCategory controller.
 *
 */
class ShippingCategoryController extends Controller
{
    /**
     * Lists all ShippingCategory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CoreBundle:ShippingCategory')->findAll();

        return $this->render('AdminBundle:ShippingCategory:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a ShippingCategory entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:ShippingCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ShippingCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:ShippingCategory:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new ShippingCategory entity.
     *
     */
    public function newAction()
    {
        $entity = new ShippingCategory();
        $form   = $this->createForm(new ShippingCategoryType(), $entity);

        return $this->render('AdminBundle:ShippingCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new ShippingCategory entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new ShippingCategory();
        $form = $this->createForm(new ShippingCategoryType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('shippingcategory_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:ShippingCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ShippingCategory entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:ShippingCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ShippingCategory entity.');
        }

        $editForm = $this->createForm(new ShippingCategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:ShippingCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing ShippingCategory entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:ShippingCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ShippingCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ShippingCategoryType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('shippingcategory_edit', array('id' => $id)));
        }

        return $this->render('AdminBundle:ShippingCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ShippingCategory entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CoreBundle:ShippingCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ShippingCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('shippingcategory'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
