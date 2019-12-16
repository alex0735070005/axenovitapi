<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login", methods={"GET", "POST"})
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
      
        if($request->isMethod('GET')) return $this->render('index.html.twig');

        $error = $authenticationUtils->getLastAuthenticationError();

        if($error) {
          return $this->json([
            'result' => false,            
            'message' => $error->getMessage(),
          ]);
        }

        $user = $this->getUser();
        
        return $this->json([
          'username' => $user->getUsername(),
          'roles' => $user->getRoles(),
      ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
