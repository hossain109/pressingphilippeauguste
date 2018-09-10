<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Contact;
use App\Entity\PageFormEntity;

class ContactAdminController extends Controller
{
    /**
     * @Route("/contact/admin", name="contact_admin")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $contacts = $em->getRepository(Contact::class)->findAll();
		//var_dump($contacts);die();
        return $this->render('contact/contactAdmin.html.twig',array('contacts'=>$contacts));
    }

    /**
     * @Route("/contact/admin/{id}", name="contact_admin_delete")
     */
    public function supprime($id)
    {
    	$em = $this->getDoctrine()->getManager();
        $contact = $em->getRepository(Contact::class)->find($id);
        if(!$contact)
    		throw $this->createNotFoundException("La page n'existe pas");
    	$em->remove($contact);
    	$em->flush();

    	return $this->redirectToRoute('contact_admin');
    }

    /**
     * @Route("/rappel/admin", name="rappel_admin")
     */
    public function rappel()
    {
        $em = $this->getDoctrine()->getManager();
        $rappels = $em->getRepository(PageFormEntity::class)->findAll();

        return $this->render('contact/rappelAdmin.html.twig',array('rappels'=>$rappels));
    }

    /**
     * @Route("/rappel/admin/{id}", name="rappel_admin_delete")
     */
    public function supprime_rappel($id)
    {
        $em = $this->getDoctrine()->getManager();
        $rappel = $em->getRepository(PageFormEntity::class)->find($id);
        if(!$rappel)
            throw $this->createNotFoundException("La page n'existe pas");
        $em->remove($rappel);
        $em->flush();

        return $this->redirectToRoute('rappel_admin');
    }

}
