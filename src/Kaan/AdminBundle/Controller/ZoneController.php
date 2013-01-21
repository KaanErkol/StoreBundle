<?php
namespace Kaan\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Kaan\CoreBundle\Entity\Zone;
use Kaan\AdminBundle\Form\ZoneType;

class ZoneController extends Controller{
    
    public function indexAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $zones = $em->getRepository('CoreBundle:Zone')->findAll();
        
        return $this->render('AdminBundle:Zone:index.html.twig',array(
            'zones' => $zones,
        ));
    }
    
    public function updateAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CoreBundle:Zone')->find($id);
        $request = $this->getRequest();
        
        if(! $entity){
            throw new NotFoundHttpException('Zone Not Found!');
        }
        $form = $this->createForm(new ZoneType(),$entity);
        if($request->isMethod('POST'))
        {
            $form->bind($request);
            if($form->isValid()){
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('zone_homepage'));
            }
        }
        
        
        
        return $this->render('AdminBundle:Zone:update.html.twig',array(
            'form' => $form->createView(),
            'entity' => $entity,
        ));
    }
    
    public function createAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = new Zone();
        $request = $this->getRequest();
        
        if(! $entity){
            throw new NotFoundHttpException('Zone Not Found!');
        }
        $form = $this->createForm(new ZoneType(),$entity);
        if($request->isMethod('POST'))
        {
            $form->bind($request);
            if($form->isValid()){
                $em->persist($entity);
                $em->flush();
            }
        }
        
        
        
        return $this->render('AdminBundle:Zone:create.html.twig',array(
            'form' => $form->createView(),
        ));   
    }
}

?>
