<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PageAdminType;
use App\Entity\Page;

class PageAdminController extends Controller
{
    /**
     * @Route("/page/admin/show", name="page_admin_show")
     */
    public function show()
    {
    	$em = $this->getDoctrine()->getManager();
    	$pages = $em->getRepository(Page::class)->findAll();

        return $this->render('page/showAdmin.html.twig', array('pages' => $pages));
    }

    /**
     * @Route("/page/admin/create", name="page_admin_create")
     */
    public function create(Request $request)
    {
    	$page = new Page();
        $form = $this->createForm(PageAdminType::class,$page);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {

        	$em = $this->getDoctrine()->getManager();
        	$em->persist($page);
       		$em->flush();

       		return $this->redirectToRoute('page_admin_show');
        }

        return $this->render('page/createAdmin.html.twig', array('form'=>$form->createView()));
    }

    /**
     * @Route("/page/admin/edit/{id}", name="page_admin_edit")
     */

    public function edit(Request $request, $id)
    {
    	$page = new Page();
    	$edit_form = $this->createForm(PageAdminType::class, $page);
    	$page_data = $this->getDoctrine()->getManager()->getRepository(Page::class)->find($id);
    	if(!$page_data)
    		throw $this->createNotFoundException("La page n'existe pas");

        //display form data from database
        $edit_form['titre']->setData($page_data->getTitre());
        $edit_form['contenu']->setData($page_data->getContenu());

        $edit_form->handleRequest($request);

    	if($edit_form->isSubmitted() && $edit_form->isValid())
    	{
        
            $page_data->setTitre($edit_form['titre']->getData($page_data->getTitre()));
            $page_data->setContenu($edit_form['contenu']->getData($page_data->getContenu()));

            //var_dump($produit_data->getId());die();
            $em = $this->getDoctrine()->getManager();
            $em->persist($page_data);
            $em->flush();
    	}



    	return $this->render('page/editAdmin.html.twig',array('edit_form'=>$edit_form->createView(),													'page_data'=>$page_data));
    }

    /**
     * @Route("/page/admin/delete/{id}", name="page_admin_delete")
     */

    public function delete($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$page = $em->getRepository(Page::class)->find($id);
    	if(!$page)
    		throw $this->createNotFoundException("La page n'existe pas");
    	$em->remove($page);
    	$em->flush();

    	return $this->redirectToRoute('page_admin_show');
    }
}
