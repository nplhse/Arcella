<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegistrationType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserController extends AbstractController
{
    /**
     * Processing the registration form.
     *
     * @Route("/register", name="registration", methods={"POST"})
     *
     * @param Request                      $request                The http-request
     * @param UserPasswordEncoderInterface $passwordEncoder        The Symfony password encoder
     * @param LoginFormAuthenticator       $loginFormAuthenticator Symfony login
     * @param GuardAuthenticatorHandler    $authenticatorHandler   Authentication Handler
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, LoginFormAuthenticator $loginFormAuthenticator, GuardAuthenticatorHandler $authenticatorHandler, TranslatorInterface $translator)
    {
        $user = new User();
        $form = $this->createForm(UserRegistrationType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->eraseCredentials();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                $translator->trans('message.welcome_user', [
                    '%username%' => $user->getUsername(),
                ])
            );

            $authenticatorHandler->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $loginFormAuthenticator,
                    'main'
                );

            return $this->redirectToRoute('homepage');
        }

        return $this->redirectToRoute('registration_form');
    }

    /**
     * Just rendering the empty registration form.
     *
     * @Route("/register", name="registration_form", methods={"GET"})
     */
    public function registerFormAction()
    {
        $form = $this->createForm(UserRegistrationType::class);

        return $this->render(
            'user/register.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
