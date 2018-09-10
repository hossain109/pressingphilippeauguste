<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Page;
use App\Entity\PageFormEntity;
use App\Form\PageFormType;


class PageController extends Controller
{

    public function menu()
    {
    	$em = $this->getDoctrine()->getManager();
    	$pages = $em->getRepository(Page::class)->findAll();
       return $this->render('page/menu.html.twig',array('pages' => $pages));
    }

    public function page($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$page = $em->getRepository(Page::class)->find($id);

    	if (!$page) {
    		throw $this->createNotFoundException("La page n'existe pas");
    		
    	}

    	return $this->render('page/page.html.twig', array('page' =>$page));
    }

    public function pageform(Request $request){

        $pageFormEntity = new PageFormEntity();
        $form = $this->createForm(PageFormType::class,$pageFormEntity, array(
                                                        'action'=>$this->generateUrl('pageForm'),
                                                        'method'=>'POST'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($pageFormEntity);
            $em->flush();

            //$session = new Session();
            //$session->start();
            $this->addFlash('success','On va vous contacter immédiatement');
            //$session->getFlashBag()->add('success','On va vous contacter immédiatement');
            
            return $this->redirectToRoute('home');
        }
       
        return $this->render('page/pageForm.html.twig', array('form'=>$form->createView()));
    }
}