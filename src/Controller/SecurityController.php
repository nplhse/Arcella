<?php

namespace App\Controller;

use App\Form\SecurityLoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * Managing the login process.
     *
     * @Route("/login", name="security_login")
     *
     * @param AuthenticationUtils $authenticationUtils Symfony authentication utilities
     *
     * @return Response the rendered response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(
            SecurityLoginType::class,
            [
                'username' => $lastUsername,
            ]
        );

        return $this->render('security/login.html.twig', ['form' => $form->createView(), 'error' => $error]);
    }

    /**
     * Dummy that appears to manage the logout process, but is just there for
     * the routing component.
     *
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
