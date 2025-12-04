<?php

namespace App\Controller;

use App\Entity\Collect;
use App\Entity\Utilisateur;
use App\Form\CollectType;
use App\Repository\CollectRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/collection')]
final class CollectController extends AbstractController
{
    #[Route(name: 'app_collect_index', methods: ['GET'])]
    public function index(CollectRepository $collectRepository): Response
    {
        $users = $collectRepository->findUsersWithGameCount();

        return $this->render('collect/index.html.twig', [
            'utilisateurs' => $users
        ]);
    }
    #[Route('/utilisateur/{user_id}',name: 'app_collect_collection', methods: ['GET'])]
    public function collection(int $user_id, CollectRepository $collectRepository, UtilisateurRepository $utilisateurRepository): Response
    {
        $collection = $collectRepository->findCollectionByUtilisateur($user_id);
        $utilisateur = $utilisateurRepository->find($user_id);
        return $this->render('collect/collection.html.twig', [
            'collection' => $collection,
            'utilisateur' => $utilisateur
        ]);
    }

    #[Route('/utilisateur/collection/{collect_id}', name: 'app_collect_show_by_ids', methods: ['GET'])]
    public function show(int $collect_id, CollectRepository $collect): Response
    {
        $collect = $collect->findOneCollectionItemByCollectAndUser($collect_id);
        return $this->render('collect/show.html.twig', [
            'collect' => $collect,
        ]);
    }
    #[Route('/new/{id}', name: 'app_collect_new', methods: ['GET', 'POST'])]
    public function new(Utilisateur $utilisateur, Request $request, EntityManagerInterface $entityManager): Response
    {
        $collect = new Collect();

        $collect->setUtilisateur($utilisateur);
        $collect->setCreatedAt(new \DateTimeImmutable());
        $collect->setDateModifStatut(new \DateTimeImmutable());

        $form = $this->createForm(CollectType::class, $collect);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($collect);
            $entityManager->flush();

            $this->addFlash('success', 'Le jeu a été ajouté à la collection de ' . $utilisateur->getPseudo() . ' !');

            return $this->redirectToRoute('app_collect_collection', ['user_id' => $utilisateur->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('collect/new.html.twig', [
            'collect' => $collect,
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }



    #[Route('/{id}/edit', name: 'app_collect_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Collect $collect, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CollectType::class, $collect);
        $form->handleRequest($request);
        $collect->setUpdatedAt(new \DateTimeImmutable());
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_collect_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('collect/edit.html.twig', [
            'collect' => $collect,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_collect_delete', methods: ['POST'])]
    public function delete(Request $request, Collect $collect, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$collect->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($collect);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_collect_index', [], Response::HTTP_SEE_OTHER);
    }
}
