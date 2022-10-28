<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AddHelper
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
    
    public function add(int $a, int $b)
    {
        $result = $a + $b;
        $email = (new Email())
            ->from('hello@example.com')
            ->to($this->adminEmail)
            ->subject('Time for Symfony Mailer!')
            ->text('Result: ' . $result)
            ->html('<p>Result: '. $result . '</p>');

        $this->mailer->send($email);
        return $result;
    }
}