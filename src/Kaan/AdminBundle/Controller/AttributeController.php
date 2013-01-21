<?php

namespace Kaan\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kaan\CoreBundle\Entity\Attribute;
use Kaan\AdminBundle\Form\AttributeType;

/**
 * Attribute controller.
 *
 */
class AttributeController extends Controller
{
    /**
     * Lists all Attribute entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CoreBundle:Attribute')->findAll();

        return $this->render('AdminBundle:Attribute:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Attribute entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Attribute')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Attribute entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Attribute:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Attribute entity.
     *
     */
    public function newAction()
    {
        $entity = new Attribute();
        $form   = $this->createForm(new AttributeType(), $entity);

        return $this->render('AdminBundle:Attribute:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Attribute entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Attribute();
        $form = $this->createForm(new AttributeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('attribute_show', array('id' => $entity->getId())));
        }

        return $this->render('AdminBundle:Attribute:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Attribute entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Attribute')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Attribute entity.');
        }

        $editForm = $this->createForm(new AttributeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Attribute:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Attribute entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Attribute')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Attribute entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AttributeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('attribute_edit', array('id' => $id)));
        }

        return $this->render('AdminBundle:Attribute:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Attribute entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CoreBundle:Attribute')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Attribute entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('attribute'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
