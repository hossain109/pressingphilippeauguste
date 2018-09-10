<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AutreController extends Controller
{
    /**
     * @Route("/autre/tapis", name="tapis")
     */
    public function tapis()
    {
        return $this->render('autre/tapis.html.twig');
    }

    /**
     * @Route("/autre/blanchissrie", name="blanchissrie")
     */
    public function blanchissrie()
    {
        return $this->render('autre/blanchissrie.html.twig');
    }

    /**
     * @Route("/autre/sec", name="sec")
     */
    public function sec()
    {
        return $this->render('autre/sec.html.twig');
    }

    /**
     * @Route("/autre/cp", name="cp")
     */
    public function cp()
    {
        return $this->render('autre/cp.html.twig');
    }
}
