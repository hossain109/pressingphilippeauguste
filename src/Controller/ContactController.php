<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Form\ContactType;
use App\Entity\Contact;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request)
    {
    	$contact = new Contact();

    	$form = $this->createForm(ContactType::class, $contact);

    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($contact);
    		$em->flush();
    		//$session = new Session();
            //$session->start();
            //$session->getFlashBag()->add('success','On va vous contacter immédiatement');
            $this->addFlash('success','On va vous contacter immédiatement');
    		return $this->redirectToRoute('contact');
    	}
        
        return $this->render('contact/contact.html.twig', array('form'=>$form->createView()));
    }
}
