<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SubjectListController extends AbstractController
{
    #[Route('/subject_list', name: 'subject_list')]
    public function index(): Response
    {
        return $this->render('subject_list/index.html.twig', [
            'controller_name' => 'SubjectListController',
        ]);
    }
}
