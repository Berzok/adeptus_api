<?php


namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FichierController extends AbstractController {

    /**
     * @Route("/image/get/{filename}", name="get_image")
     * @param string $filename
     * @return BinaryFileResponse
     */
    public function getImage(string $filename): BinaryFileResponse {

        $file = 'uploads/' . $filename;
        $response = new BinaryFileResponse($file);

        return new BinaryFileResponse($file, 200);
    }
}