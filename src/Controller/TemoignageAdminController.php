<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Temoignages;

class TemoignageAdminController extends Controller
{
    /**
     * @Route("/temoignage/admin", name="temoignage_admin")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $temoignages = $em->getRepository(Temoignages::class)->findAll();

        return $this->render('temoignage/temoignageAdmin.html.twig',array('temoignages'=>$temoignages));
    }

    /**
     * @Route("/temoignage/admin/{id}", name="temoignage_admin_delete")
     */
    public function supprime($id)
    {
    	$em = $this->getDoctrine()->getManager();
        $temoignage = $em->getRepository(Temoignages::class)->find($id);
        if(!$temoignage)
    		throw $this->createNotFoundException("La page n'existe pas");
    	$em->remove($temoignage);
    	$em->flush();

    	return $this->redirectToRoute('temoignage_admin');
    }
}
