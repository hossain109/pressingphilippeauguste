<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\HomeForm;

class HomeController extends Controller
{

    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $images = $em->getRepository(HomeForm::class)->findAll();
        return $this->render('home/home.html.twig',array('images'=>$images));
    }

}
