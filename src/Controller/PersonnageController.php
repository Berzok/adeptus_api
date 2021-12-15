<?php

namespace App\Controller;

use App\Entity\Caracteristique;
use App\Entity\Origine;
use App\Entity\Personnage;
use App\Form\PersonnageType;
use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonnageController extends AbstractController {

    #[Route('/personnage', name: 'personnage')]
    public function index(): Response {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PersonnageController.php',
        ]);
    }


    /**
     * @Route("/personnages", name="get_personnages")
     * @param SerializerInterface $serializer
     * @param ManagerRegistry $doctrine
     * @return JsonResponse
     */
    public function getAll(ManagerRegistry $doctrine, SerializerInterface $serializer): JsonResponse {

        $repository = $doctrine->getRepository(Personnage::class);
        $data = $repository->findAll();

        $json = $serializer->serialize($data, 'json');

        return JsonResponse::fromJsonString(
            $json,
            Response::HTTP_OK
        );
    }

    /**
     * @Route("/personnages/list", name="get_personnages_list")
     * @param SerializerInterface $serializer
     * @param ManagerRegistry $doctrine
     * @return JsonResponse
     */
    public function getList(ManagerRegistry $doctrine, SerializerInterface $serializer): JsonResponse {

        $repository = $doctrine->getRepository(Personnage::class);
        $data = $repository->findAll();

        foreach ($data as $key => $value) {
            $data[$key] = array(
                'id' => $value->getId(),
                'prenom' => $value->getPrenom(),
                'image' => $value->getImage()
            );
        }

        $json = $serializer->serialize($data, 'json');

        return JsonResponse::fromJsonString(
            $json,
            Response::HTTP_OK
        );
    }


    /**
     * @Route("/personnage/get/empty", name="get_personnage_empty")
     * @param SerializerInterface $serializer
     * @param ManagerRegistry $doctrine
     * @return JsonResponse
     */
    public function getEmpty(ManagerRegistry $doctrine, SerializerInterface $serializer): JsonResponse {

        $repository = $doctrine->getRepository(Personnage::class);
        $empty = $repository->getEmpty($doctrine);

        //We serialize the empty character, even with the null values
        $context = new SerializationContext();
        $context->setSerializeNull(true);

        $json = $serializer->serialize($empty, 'json');

        //Conversion of the json to array
        $json = json_decode($json, true);


        //Setting competences to null
        foreach ($json['competences'] as $key => $value) {
            $json['competences'][$key]['score'] = 0;
            $json['competences'][$key]['bonus'] = 0;
        }

        $json = json_encode($json);

        return JsonResponse::fromJsonString(
            $json,
            Response::HTTP_OK
        );
    }

    /**
     * @Route("/personnage/get/{id}", name="get_personnage_unique")
     * @param int $id
     * @param SerializerInterface $serializer
     * @param ManagerRegistry $doctrine
     * @return JsonResponse
     */
    public function getPersonnage(int $id, ManagerRegistry $doctrine, SerializerInterface $serializer): Response {

        $repository = $doctrine->getRepository(Personnage::class);
        $data = $repository->find($id);

//        $data->setImage('http://adeptus-sheet/image/get/' . $data->getImage());

        $context = new SerializationContext();
        $context->setSerializeNull(true);

        //return new Response('<pre>' . print_r($data) . '</pre>', Response::HTTP_OK, ['content-type' => 'text/html']);

        $json = $serializer->serialize($data, 'json', $context);

        return JsonResponse::fromJsonString(
            $json,
            Response::HTTP_OK
        );
    }

    /**
     * @Route("/personnage/save", name="save_personnage")
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function createOrSave(Request $request, ManagerRegistry $doctrine, SerializerInterface $serializer): Response {

        $em = $doctrine->getManager();
        $repository = $em->getRepository(Personnage::class);
        $post = $request->toArray();

        if(isset($post['id'])){
            $personnage = $repository->find($post['id']);
        } else{
            $personnage = new Personnage();
        }

        $formPersonnage = $this->createForm(PersonnageType::class, $personnage);
        //$formPersonnage->handleRequest($request);

        $formPersonnage->submit($post, false);
        if ($formPersonnage->isSubmitted()) {

            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $data = $formPersonnage->getData();


            // ... perform some action, such as saving the task to the database
            if ($personnage->getId() !== null) {
                $data2 = $repository->save($personnage);
            } else {
                $data2 = $repository->create($personnage);
            }


            $conn = $em->getConnection();

            $sql = '
            UPDATE personnage
            SET id_origine = :id_origine
            WHERE id = :id';

            $statement = $conn->prepare($sql);
            $result = $statement->executeQuery([
                'id_origine' => $personnage->getOrigine()->getId(),
                'id' => $personnage->getId()
            ]);

            $em->flush();

            //return new Response('<pre>' . print_r($data) . '</pre>', Response::HTTP_OK, ['content-type' => 'text/html']);

            //$data->setImage( $personnage->getImage());

            $json = $serializer->serialize($data, 'json');
            return JsonResponse::fromJsonString(
                $json,
                Response::HTTP_OK
            );
        }

        //$json = $serializer->serialize($data, 'json');


    }
}
