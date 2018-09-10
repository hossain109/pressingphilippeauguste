<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Temoignages;
use App\Form\TemoignageType;


class TemoignageController extends Controller
{
    /**
     * @Route("/temoignage", name="temoignage")
     */
    public function index(Request $request)
    {
    	$avises  = $this->getDoctrine()->getManager()->getRepository(Temoignages::class)->findAll();

    	$temoignages = new Temoignages();

    	$form = $this->createForm(TemoignageType::class, $temoignages);
    	$form->handleRequest($request);
    	if($form->isSubmitted() && $form->isValid())
    	{
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($temoignages);
    		$em->flush();

            return $this->redirectToRoute('temoignage');
    	}

       return $this->render('temoignage/temoignage.html.twig', array('form' => $form->createView(),															'avises' => $avises));
    }
}
