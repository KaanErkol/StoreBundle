<?php

namespace Kaan\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Kaan\UserBundle\Entity\User;
use Kaan\AdminBundle\Form\UserType;

class UserController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->getRequest();

        $query = $em->createQueryBuilder()
                ->select('u')
                ->from('UserBundle:User', 'u');
        if ($request->query->get('username')) {
            $query->where('u.username = :username');
            $query->setParameter('username', $request->query->get('username'));
        }

        if ($request->query->get('email')) {
            $query->where('u.email = :email');
            $query->setParameter('email', $request->query->get('email'));
        }


        $paginator = $this->get('knp_paginator');
        $users = $paginator->paginate(
                $query->getQuery(), $this->get('request')->query->get('page', 1)/* page number */, 50/* limit per page */
        );

        return $this->render('AdminBundle:User:index.html.twig', array(
                    'users' => $users,
                ));
    }

    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('UserBundle:User')->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('Üye Bulunamadı');
        }
        return $this->render('AdminBundle:User:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $this->createDeleteForm($entity->getId())->createView(),
                ));
    }

    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('UserBundle:User')->find($id);
        $request = $this->getRequest();
        if (!$entity) {
            throw new NotFoundHttpException('Üye Bulunamadı');
        }

        $form = $this->createForm(new UserType(), $entity);
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $password = $form['password']->getData();
                if($password){
                    $encoder = new MessageDigestPasswordEncoder('sha512',true,10);
                    $entity->setSalt(md5(time()));
                    $entity->setPassword($encoder->encodePassword($password, $entity->getSalt()));
                }
                $em->persist($entity);
                $em->flush();
            }
        }

        return $this->render('AdminBundle:User:update.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $form->createView(),
                    'delete_form' => $this->createDeleteForm($entity->getId())->createView(),
                ));
    }
        public function createAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = new User();
        $request = $this->getRequest();

        $form = $this->createForm(new UserType(), $entity);
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $password = $form['password']->getData();
                $encoder = new MessageDigestPasswordEncoder('sha512',true,10);
                $entity->setSalt(md5(time()));
                $entity->setPassword($encoder->encodePassword($password, $entity->getSalt()));

                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('user_show',array('id'=>$entity->getId())));
            }
        }

        return $this->render('AdminBundle:User:create.html.twig', array(
                    'form' => $form->createView(),
                ));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}