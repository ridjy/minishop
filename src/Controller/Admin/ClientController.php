<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/client')]
final class ClientController extends AbstractController
{
    #[Route(name: 'admin_client_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em, Request $request, UserRepository $userRepository): Response
    {
        $clients = Pagerfanta::createForCurrentPageWithMaxPerPage(
            new QueryAdapter($userRepository->clientList()),
            $request->query->getInt('page', 1),
            10)
        ;
        return $this->render('admin/client/index.html.twig', [
            'clients' => $clients,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_client_show', methods: ['GET'])]
    public function show(User $client): Response
    {
        return $this->render('admin/client/show.html.twig', [
            'client' => $client,
        ]);
    }
}
