<?php

namespace App\Service;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Twig\Environment;

class MailService {

    private $mailer;
    private $twig;

    public function __construct(MailerInterface $mailer, Environment $twig) {
        $this->mailer = $mailer;
        $this->twig = $twig;
        }

        public function sendVerify(string $email, string $apiKey) {

        $htmlConfirm = $this->twig->render('confirmSend.html.twig', ['apiKey' => $apiKey]);

        $emailBody = (new Email())
                ->from('axenovit@gmail.com')
                ->to($email)
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Welcome to axenov it blog API')
                ->text('Confirm Your Email')
                ->html($htmlConfirm);

        $this->mailer->send($emailBody);
    }

}
