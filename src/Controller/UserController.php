<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Service\ValidateService;
use App\Service\MailService;

class UserController extends AbstractController {

    /**
     * @Route("/user", name="addUser", methods={"post"})
     */
    public function addUser(Request $request, MailService $mailService) {
        header('Access-Control-Allow-Origin: *');

        $dataUser = json_decode($request->getContent());

        $notValidResponse = ValidateService::validateRegistration($dataUser);

        if ($notValidResponse !== true) {
            return $this->json($notValidResponse);
        }

        $repoUser = $this->getDoctrine()->getManager()->getRepository(User::class);

        $User = $repoUser->addUser($dataUser);

        $mailService->sendVerify($User->getEmail(), $User->getApiKey());

        return $this->json([
                    'result' => true,
                    'message' => 'You are registration success, let`s go confirm your email address',
        ]);
    }

    /**
     * @Route("/registration", name="registration", methods={"GET", "POST"})
     */
    public function registration(Request $request, MailService $mailService, UserPasswordEncoderInterface $passwordEncoder) {
        $dataUser = $request->getContent();

        if($request->isMethod('GET')){
            return $this->render('registration.html.twig');
        }       
        
        $dataUser = $request->request->all();
        
        $notValidResponse = ValidateService::validateRegistration($dataUser);

        $repoUser = $this->getDoctrine()->getManager()->getRepository(User::class);
        
        $User = $repoUser->addUser($dataUser, $passwordEncoder);

        $mailService->sendVerify($User->getEmail(), $User->getApiKey());

        // return $this->render('registrationSuccess.html.twig');
        return $this->redirectToRoute('login');
    }
  
    
    /**
     * @Route("/personal", name="personal", methods={"GET"})
     */
    public function personal() {
        header('Access-Control-Allow-Origin: *');

        $user = $this->getUser();
        // dump($data);
        
        return $this->render('personal.html.twig', [            
            'username'=>$user->getUsername(),
            'apiKey'=>$user->getApiKey(),
            'email'=>$user->getEmail(),
            'verify'=>$user->getVerify(),
            'dataUpdate'=>$user->getDateUpdate(),
        ]);        
    }

    /**
     * @Route("/verify/{apiKey}", name="verify", methods={"get"})
     */
    public function verify($apiKey) {
        $repoUser = $this->getDoctrine()->getManager()->getRepository(User::class);

        $isFerified = $repoUser->verifyEmail($apiKey);

        if ($isFerified) {
            return $this->render('confirmSuccess.html.twig');
        }
        echo ('<h1>This is user not found</h1>');
        die;
    }

}
