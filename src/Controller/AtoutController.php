<?php

namespace App\Controller;

use App\Entity\Atout;
use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AtoutController extends AbstractController {

    /**
     * @Route("/atouts", name="get_atouts")
     * @param SerializerInterface $serializer
     * @param ManagerRegistry $doctrine
     * @return JsonResponse
     */
    public function getAll(ManagerRegistry $doctrine, SerializerInterface $serializer) {
        $repository = $doctrine->getRepository(Atout::class);
        $data = $repository->findAll();

        $context = new SerializationContext();
        $context->setSerializeNull(true);

        $json = $serializer->serialize($data, 'json', $context);

        return JsonResponse::fromJsonString(
            $json,
            Response::HTTP_OK
        );
    }
}
