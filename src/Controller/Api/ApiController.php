<?php

namespace App\Controller\Api;

use App\Entity\Genre;
use App\Entity\Utilisateur;
use App\Repository\CollectRepository;
use App\Repository\GenreRepository;
use App\Repository\JeuVideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;
#[Route('/api', name: 'api')]
final class ApiController extends AbstractController
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @throws ExceptionInterface
     */
    private function jsonResponse(mixed $data, bool $success, int $status = 200, array $groups = ['read']): JsonResponse
    {
        $count = is_array($data) ?  count($data) : 1;

        $serializedData = $this->serializer->normalize($data, 'json', ['groups' => $groups]);

        $responsePayload = [
            'success' => $success,
            'count' => $count,
            'data' => $serializedData,
        ];
        return new JsonResponse($responsePayload, $status);
    }

    /**
     * @throws ExceptionInterface
     */
    #[Route('/jeu_video', name: 'jeu_video_index', methods: ['GET'])]
    public function jeuVideoIndex(JeuVideoRepository $jeuVideoRepository): JsonResponse
    {
        $jeux = $jeuVideoRepository->findAll();
        if (!empty($jeux) && is_array($jeux)) {
            return $this->jsonResponse($jeux, true, 200, ['jv:read', 'titre:seul']);
        }
        return $this->jsonResponse(null, true, 404, ['jv:read', 'titre:seul']);

    }
    /**
     * @throws ExceptionInterface
     */
    #[Route('/jeu_video/{id}', name: 'jeu_video', methods: ['GET'])]
    public function jeuVideo(int $id, JeuVideoRepository $jeuVideoRepository): JsonResponse
    {
        $jeux = $jeuVideoRepository->findOneBy(['id'=>$id]);
        if (!empty($jeux) && is_array($jeux)) {
            return $this->jsonResponse($jeux, true, 200, ['jv:read', 'titre:seul']);
        }
        return $this->jsonResponse(null, false, 404, ['jv:read', 'titre:seul']);

    }

    /**
     * @throws ExceptionInterface
     */
    #[Route('/genre', name: 'genre_index', methods: ['GET'])]
    public function genreIndex(GenreRepository $genreRepository): JsonResponse
    {

        $genre = $genreRepository->findAll();
        if (!empty($genre) && is_array($genre)) {
            return $this->jsonResponse($genre, true,200, ['genre:read']);
        }
        return $this->jsonResponse(null, false, 404, ['genre:read']);
    }

    /**
     * @throws ExceptionInterface
     */
    #[Route('/genre/{id}', name: 'genre', methods: ['GET'])]
    public function  genre(int $id, JeuVideoRepository $genreRepository): JsonResponse
    {
        $genre = $genreRepository->findOneBy(['id' => $id]);

        if (!empty($genre) && is_array($genre)) {
            return $this->jsonResponse($genre, true,200, ['genre:read']);
        }
        return $this->jsonResponse(null, false, 404, ['genre:read']);

    }

    #[Route('/utilisateur/{id}/collection', name: 'utilisateur_collection', methods: ['GET'])]
    public function utilisateurCollection(Utilisateur $utilisateur, CollectRepository $collectRepository): JsonResponse
    {
        $collection = $collectRepository->findCollectionByUtilisateur($utilisateur->getId());
        if (!empty($collection) && is_array($collection)) {
            return $this->jsonResponse($collection, true, 200, ['collect:read','minimum']);
        }
        return $this->jsonResponse(null, false, 404, ['collect:read', 'titre:seul']);
    }

    #[Route('/genre/{id}', name: 'genre_delete', methods: ['DELETE'])]
    public function genreDelete(Genre $genre, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($genre);
        $entityManager->flush();

        return $this->jsonResponse(null, true,202);
    }

    #[Route('/ping', name: 'ping', methods: ['GET'])]
    public function ping(): JsonResponse
    {
        return new JsonResponse(['message' => 'pong'], 200);
    }

    #[Route('/healthcheck', name: 'healthcheck', methods: ['GET'])]
    public function healthCheck(ManagerRegistry $doctrine): JsonResponse
    {
        $healthStatus = [
            'api_status' => 'OK',
            'api_version' => '1.0',
            'timestamp' => (new \DateTime())->format(\DateTimeInterface::ATOM),
            'dependencies' => [],
        ];

        $httpStatus = 200;

        try {
            $connection = $doctrine->getManager()->getConnection();
            $connection->connect();

            $healthStatus['dependencies']['database'] = [
                'status' => 'UP',
                'details' => $connection->getDatabasePlatform()->getName(),
            ];

        } catch (\Exception $e) {
            $healthStatus['dependencies']['database'] = [
                'status' => 'DOWN',
                'error_message' => $e->getMessage(),
            ];
            $healthStatus['api_status'] = 'DEGRADED';
            $httpStatus = 503;
        }

        $healthStatus['dependencies']['filesystem_access'] = [
            'status' => is_writable($this->getParameter('kernel.project_dir') . '/var') ? 'UP' : 'DOWN',
        ];

        return $this->json($healthStatus, $httpStatus);
    }


}
