<?php

namespace App\Controller;

use App\Entity\Handicap;
use Doctrine\Persistence\ManagerRegistry;
use Gedmo\Translatable\Entity\Translation;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HandicapController extends AbstractController {

    /**
     * @Route("/handicaps", name="get_handicaps")
     * @param SerializerInterface $serializer
     * @param ManagerRegistry $doctrine
     * @return JsonResponse
     */
    public function getAll(ManagerRegistry $doctrine, SerializerInterface $serializer) {
        $repository = $doctrine->getRepository(Handicap::class);
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
