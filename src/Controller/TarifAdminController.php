<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\TarifAdminType;
use App\Entity\Produits;

class TarifAdminController extends Controller
{
    /**
     * @Route("/tarif/admin/show", name="tarif_admin_show")
     */
    public function show()
    {
        // replace this line with your own code!
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository(Produits::class)->findAll();

        return $this->render('tarif/show.html.twig', array('produits'=>$produits));
    }

    /**
    *@Route("/tarif/admin/create", name="tarif_admin_create")
    */
    public function create(Request $request)
    {
        $produits = new Produits();

        $form = $this->createForm(TarifAdminType::class, $produits);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($produits);
            $em->flush();

            return $this->redirectToRoute('tarif_admin_show');
        }


    	return $this->render('tarif/createAdmin.html.twig', array('form'=>$form->createView()));
    }

    /**
    *@Route("/tarif/admin/edit/{id}", name="tarif_admin_edit")
    */
    public function edit(Request $request, $id)
    {
        
        $produits = new Produits();
        $edit_form = $this->createForm(TarifAdminType::class, $produits);

        $produit_data = $this->getDoctrine()->getManager()->getRepository(Produits::class)->find($id);

        if(!$produit_data)
            throw $this->createNotFoundException("La page n'existe pas");
        //display form data from database
        $edit_form['categorie']->setData($produit_data->getCategorie());
        $edit_form['nom']->setData($produit_data->getNom());
        $edit_form['prix']->setData($produit_data->getPrix());
        $edit_form['disponible']->setData($produit_data->getDisponible());

        $edit_form->handleRequest($request);

        if($edit_form->isSubmitted() && $edit_form->isValid())
        {
            //assign input into object
            $produit_data->setCategorie($edit_form['categorie']->getData($produit_data->getCategorie()));
            $produit_data->setNom($edit_form['nom']->getData($produit_data->getNom()));
            $produit_data->setPrix($edit_form['prix']->getData($produit_data->getPrix()));
            $produit_data->setDisponible($edit_form['disponible']->getData($produit_data->getDisponible()));
            //var_dump($produit_data->getId());die();
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit_data);
            $em->flush();
        }



        return $this->render('tarif/edit.html.twig',array('edit_form'=>$edit_form->createView(),
                                                            'produit_data'=>$produit_data));
    }

    /**
    *@Route("/tarif/admin/delete/{id}", name="tarif_admin_delete")
    */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository(Produits::class)->find($id);
        //var_dump($produit->getId());die;
        if(!$produit)
            throw $this->createNotFoundException("La page n'existe pas");
        $em->remove($produit);
        $em->flush();

        return $this->redirectToRoute('tarif_admin_show');
    }
}
