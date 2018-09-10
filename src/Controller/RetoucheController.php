<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class RetoucheController extends Controller
{
    /**
     * @Route("/retouche", name="retouche")
     */
    public function index()
    {
    	
        return $this->render('retouche.html.twig');
    }
}
