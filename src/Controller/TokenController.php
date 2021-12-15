<?php

namespace App\Controller;

use App\Entity\Competence;
use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TokenController extends AbstractController {

    /**
     * @Route("/token/verify", name="check_token")
     * @param Request $request
     * @return JsonResponse
     */
    public function check(Request $request): Response {

        $token = $request->toArray()['token'];
        $isValid = $token === $_ENV['AUTH_TOKEN'];

        return new JsonResponse($isValid, Response::HTTP_OK);
    }
}
