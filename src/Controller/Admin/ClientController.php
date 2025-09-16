<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ClientController extends AbstractController
{
    #[Route('/admin/client', name: 'admin_client_index')]
    public function index(): Response
    {
        return $this->render('admin/client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }
}
