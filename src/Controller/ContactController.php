<?php

namespace App\Controller;

use App\Service\MailService;
use App\Service\AddHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact")
     */
    public function sendMessage(MailService $mailService):Response
    {
        $mailService->sendMail();
        return new Response('<h1>Mail został właśnie wysłany :)</h1>');
    }
}