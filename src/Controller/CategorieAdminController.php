<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Categories;
use App\Entity\Produits;
use App\Form\CategorieAdminType;

class CategorieAdminController extends Controller
{
    /**
     * @Route("/catgorie/admin/show", name="categorie_admin_show")
     */
    public function show()
    {
    	$em = $this->getDoctrine()->getManager();
    	$categories = $em->getRepository(Categories::class)->findAll();

        return $this->render('categorie/show.html.twig', array('categories' => $categories));
    }

    /**
     * @Route("/categorie/admin/create", name="categorie_admin_create")
     */
    public function create(Request $request)
    {
    	$Categorie = new Categories();
        $form = $this->createForm(CategorieAdminType::class,$Categorie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {

        	$em = $this->getDoctrine()->getManager();
        	$em->persist($Categorie);
       		$em->flush();

       		return $this->redirectToRoute('categorie_admin_show');
        }

        return $this->render('categorie/createAdmin.html.twig', array('form'=>$form->createView()));
    }

    /**
     * @Route("/categorie/admin/edit/{id}", name="categorie_admin_edit")
     */
    public function edit(Request $request, $id)
    {
    	$categorie = new Categories();
    	$edit_form = $this->createForm(CategorieAdminType::class, $categorie);
    	$categorie_data = $this->getDoctrine()->getManager()->getRepository(Categories::class)->find($id);
    	if(!$categorie_data)
    		throw $this->createNotFoundException("La page n'existe pas");

        //display form data from database
        $edit_form['categorie']->setData($categorie_data->getCategorie());


        $edit_form->handleRequest($request);

    	if($edit_form->isSubmitted() && $edit_form->isValid())
    	{
            $categorie_data->setCategorie($edit_form['categorie']->getData($categorie_data->getCategorie()));

            //var_dump($produit_data->getId());die();
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie_data);
            $em->flush();
    	}



    	return $this->render('categorie/edit.html.twig',array('edit_form'=>$edit_form->createView(),'categorie_data'=>$categorie_data));
    }

    /**
     * @Route("/categorie/admin/delete/{id}", name="categorie_admin_delete")
     */
    public function delete($id)
    {

    	$em = $this->getDoctrine()->getManager();
    	$categorie = $em->getRepository(Categories::class)->find($id);

    	if(!$categorie)
    		throw $this->createNotFoundException("La page n'existe pas");
         $prod_cat = $em->getRepository(Produits::class)->findByCategorie($id);
         if ($prod_cat) {
            throw $this->createNotFoundException("D'abord il fault suprimer tous les produits dans cette categorie");
         }
    	$em->remove($categorie);
    	$em->flush();
    	return $this->redirectToRoute('categorie_admin_show');
    }
}
