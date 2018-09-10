<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\HomeForm;
use App\Form\HomeFormType;

class HomeAdminController extends Controller
{
	/**
     * @Route("/home/admin/show", name="home_admin_show")
     */
	public function show()
	{
		$em = $this->getDoctrine()->getManager();

        $images = $em->getRepository(HomeForm::class)->findAll();
        //var_dump($images[0]->getId());die;
        $counts  = $em->getRepository(HomeForm::class)->count($images);
        //var_dump($counts);die;

        return $this->render('home/homeShowAdmin.html.twig', array('images'=>$images,'counts'=>$counts));
	}

    /**
     * @Route("/home/admin", name="home_admin")
     */
    public function new(Request $request)
    {
    
    	$homeForm = new HomeForm();
    	$form = $this->createForm(HomeFormType::class, $homeForm);

    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) {
    		// $file stores the uploaded IMAGE file

            $file = $homeForm->getPath();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('image_directory'),
                $fileName
            );

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $homeForm->setPath($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($homeForm);
            $em->flush();

    		return $this->redirectToRoute('home_admin_show');
    	}

        return $this->render('home/homeAdmin.html.twig', array('form'=>$form->createView()));
    }

    /**
    *@Route("/home/admin/delete/{id}", name="home_admin_delete")
    */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository(HomeForm::class)->find($id);
        if(!$image)
            throw $this->createNotFoundException("La page n'existe pas");
        $em->remove($image);
        $em->flush();

        return $this->redirectToRoute('home_admin_show');
    }
}
