<?php

namespace App\Controller;

use App\Service\AddHelper;
use App\Service\MailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(AddHelper $addHelper): Response
    {
        dd($addHelper->add(12, 13));
        return new Response('<h1>Hello world !</h1>');
    }
    
    /**
     * @Route("/about")
     */
    public function index1(MailService $mailService): Response
    {
        dd($mailService->sendMail());
        return new Response('<h1>Hello world !</h1>');
    }
}