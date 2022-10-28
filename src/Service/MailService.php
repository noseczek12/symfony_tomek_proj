<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService
{
    /**
     * @var MailerInterface
     */
    public $mailer;
    
    private $adminEmail;
    
    public function __construct(MailerInterface $mailer, string $adminEmail)
    {
        $this->mailer = $mailer;
        $this->adminEmail = $adminEmail;
    }
    
    public function sendMail()
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to($this->adminEmail)
            ->subject('Mail kontaktowy')
            ->text('Miło Cię poznać!')
            ->html('<p>Miło Cię poznać!</p>');

        $this->mailer->send($email);
    }
}