<?php

namespace App\Controller\back;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin')]
class BackController extends AbstractController
{
    #[Route('/all', name: 'app_back-office')]
    public function backback()
    {
        return $this->render('/back/index.html.twig');
    }
}