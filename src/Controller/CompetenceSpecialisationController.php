<?php

namespace App\Controller;

use App\Entity\CompetenceSpecialisation;
use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompetenceSpecialisationController extends AbstractController {

    #[Route('/competence/specialisation', name: 'competence_specialisation')]
    public function index(): Response {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CompetenceSpecialisationController.php',
        ]);
    }

    /**
     * @Route("/specialisations", name="get_specialisations")
     * @param SerializerInterface $serializer
     * @param ManagerRegistry $doctrine
     * @return JsonResponse
     */
    public function getAll(ManagerRegistry $doctrine, SerializerInterface $serializer): JsonResponse {

        $repository = $doctrine->getRepository(CompetenceSpecialisation::class);
        $data = $repository->findAll();

        $json = $serializer->serialize($data, 'json');

        return JsonResponse::fromJsonString(
            $json,
            Response::HTTP_OK
        );
    }
}
