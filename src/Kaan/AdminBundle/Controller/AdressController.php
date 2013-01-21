<?php

namespace Kaan\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kaan\CoreBundle\Entity\Adress;
use Kaan\AdminBundle\Form\AdressType;

/**
 * Adress controller.
 *
 */
class AdressController extends Controller
{
    /**
     * Lists all Adress entities.
     *
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CoreBundle:Adress')->findBy(array('user' => $id));

        return $this->render('AdminBundle:Adress:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Adress entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Adress')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adress entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Adress:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Adress entity.
     *
     */
    public function newAction()
    {
        $entity = new Adress();
        $form   = $this->createForm(new AdressType(), $entity);

        return $this->render('AdminBundle:Adress:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Adress entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Adress();
        $form = $this->createForm(new AdressType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $userid =  $request->request->get('userid');
            $user = $em->getRepository('UserBundle:User')->find($userid);
            if(! $user){
                throw $this->createNotFoundException('Bulunamadı');
            }
            $entity->setUser($user);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('adress_show', array('id' => $entity->getId())).'?id='.$userid);
        }

        return $this->render('AdminBundle:Adress:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Adress entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Adress')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adress entity.');
        }

        $editForm = $this->createForm(new AdressType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Adress:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Adress entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CoreBundle:Adress')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Adress entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AdressType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $userid = $request->request->get('userid');
            if($userid){
                $user = $em->getRepository('UserBundle:User')->find($userid);
                if(! $user){
                    throw $this->createNotFoundException('Bulunamadı');
                }
                $entity->setUser($user);
            }
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('adress_edit', array('id' => $id)).'?id='.$userid);
        }

        return $this->render('AdminBundle:Adress:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Adress entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CoreBundle:Adress')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Adress entity.');
            }
            $userid = $entity->getUser()->getId();
            $em->remove($entity);
            $em->flush();
        }
        
        return $this->redirect($this->generateUrl('adress',array('id'=>$userid)));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
