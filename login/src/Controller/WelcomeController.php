<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/login/", name="welcome")
     */
    public function index()
    {
        return $this->redirect('/login/login');
        /*
        return $this->render('welcome/index.html.twig', [
            'controller_name' => 'WelcomeController',
        ]);
        */
    }
}
