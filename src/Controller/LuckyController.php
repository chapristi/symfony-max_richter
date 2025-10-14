<?php

namespace App\Controller;

use Random\RandomException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/lucky')]
final class LuckyController extends AbstractController
{
    /**
     * @throws RandomException
     */
    #[Route('/number', name: 'app_lucky', methods: ['GET','POST'])]
    public function index(): Response
    {
        $number = random_int(0,100);
        return $this->render('lucky/index.html.twig', ['number' => $number]);
    }
}
