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

class AdminController extends AbstractController {

    /**
     * @Route("/admin/users", name="getUsers", methods={"GET"})
     */
    public function getUsers() {     
        $repoUser = $this->getDoctrine()->getManager()->getRepository(User::class);
        $users = $repoUser->getUsers();
        
        return $this->json([
                    'result' => true,
                    'users' => $users,
                    'message' => '',
        ]);
    }

    /**
     * @Route("/registration", name="registration", methods={"GET", "POST"})
     */
    public function registration(Request $request, MailService $mailService, UserPasswordEncoderInterface $passwordEncoder) {

        if ($request->isMethod('GET'))
            return $this->render('index.html.twig');

        $dataUser = json_decode(file_get_contents('php://input'), true);

        $notValidResponse = ValidateService::validateRegistration($dataUser);

        $repoUser = $this->getDoctrine()->getManager()->getRepository(User::class);

        $User = $repoUser->addUser($dataUser, $passwordEncoder);

        $mailService->sendVerify($User->getEmail(), $User->getApiKey());

        // return $this->render('registrationSuccess.html.twig');
        return $this->json([
                    'result' => true,
                    'message' => 'You are registration success',
        ]);
    }

    /**
     * @Route("/personal", name="personal", methods={"GET"})
     */
    public function personal(Request $request) {

        $isJson = preg_match('/application\/json/', $request->headers->get('accept'));
        if (!$isJson)
            return $this->render('index.html.twig');

        $user = $this->getUser();

        return $this->json([
                    'username' => $user->getUsername(),
                    'apiKey' => $user->getApiKey(),
                    'email' => $user->getEmail(),
                    'verify' => $user->getVerify(),
                    'dataUpdate' => $user->getDateUpdate(),
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
