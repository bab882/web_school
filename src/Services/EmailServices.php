<?php

namespace App\Services;

use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class EmailServices
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail($form): void
    {
        $email = (new TemplatedEmail())
            ->from($form->get('email')->getData())
            ->to('no-reply@viviani.fr')
            ->replyTo($form->get('email')->getData())
            ->priority(Email::PRIORITY_HIGH)
            ->subject('Nouveau message')
            ->htmlTemplate('email/contact.html.twig')
            ->context(compact('form'))
        ;
        $this->mailer->send($email);
    }
}