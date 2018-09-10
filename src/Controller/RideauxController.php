<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class RideauxController extends Controller
{
    /**
     * @Route("/rideaux", name="rideaux")
     */
    public function index()
    {

        return $this->render('rideaux.html.twig');
    }
}
