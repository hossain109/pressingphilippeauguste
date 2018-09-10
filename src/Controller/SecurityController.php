<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Form\UserType;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
public function login(Request $request, AuthenticationUtils $authenticationUtils)
	{
	    // get the login error if there is one
	    $error = $authenticationUtils->getLastAuthenticationError();

	    // last username entered by the user
	    $lastUsername = $authenticationUtils->getLastUsername();

      $this->addFlash('notice','username or password invalid.');

	    return $this->render('security/login.html.twig', array(
	        'last_username' => $lastUsername,
	        'error'         => $error,
	    ));
	}

	/**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success','votre compte a crée avec succès.');

            return $this->redirectToRoute('user_registration');
        }

        return $this->render(
            'security/register.html.twig',
            array('form' => $form->createView())
        );
    }

   	/**
     * @Route("/user/show", name="user_show")
     */

   	public function showUser()
   	{
   		$em = $this->getDoctrine()->getManager();
   		$users = $em->getRepository(User::class)->findAll();

   		return $this->render('security/show.html.twig',array('users'=>$users));
   	}

   	/**
    *@Route("/user/delete/{id}", name="user_delete")
    */
   	public function deleteUser($id)
   	{
   		$em = $this->getDoctrine()->getManager();
   		$user = $em->getRepository(User::class)->find($id);
   		$em->remove($user);
   		$em->flush();

   		return $this->redirectToRoute('user_show');
   	}

    /**
    *@Route("/logout", name="logout")
    */
    public function logout()
    {
      $this->get('security.context')->setToken(null);
      $this->get('request')->getSession()->invalidate();
      return $this->redirect($this->generateUrl('home'));
    }
}