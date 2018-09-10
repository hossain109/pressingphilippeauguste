<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Categories;
use App\Entity\Produits;

class TarifController extends Controller
{
    /**
     * @Route("/tarif", name="tarif")
     */
    public function index()
    {
    	$em = $this->getDoctrine()->getManager();
    	//$produits = $em->getRepository(Produits::class)->findByCategorie($categorie=5);
    	$categories = $em->getRepository(Categories::class)->findAll();

    	//$produits = $em->getRepository(Produits::class)->findAll();
    	$produits= array();
    	for ($i=0; $i <count($categories) ; $i++) { 
    		$categorie = $categories[$i]->getCategorie();
    		$produits[$i] = $em->getRepository(Produits::class)->findByCategorie($categories[$i]->getId());
    		
    	}
    	return $this->render('tarif/tarif.html.twig',array('produits'=>$produits,'categories'=>$categories));
    	/*for ($i=0; $i <count($categories) ; $i++) { 
    		echo $categories[$i]->getCategorie()."<br>";
    		for ($j=0; $j <count($produits[$i]) ; $j++) { 
    			echo $produits[$i][$j]->getNom();
    			echo $produits[$i][$j]->getPrix();
    		}
    		echo "<br>";
    
    	}*/
    	
    	
    }

}
