<?php

namespace App\Controller\Back;

use App\Repository\UserRepository;
use App\Service\ValidationUserValues;
use App\Repository\ResponsesRepository;
use App\Repository\BabyQuestionsRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ParentsQuestionsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function home(): Response
    {
        return $this->render('backoffice/index.html.twig');
    }
}
