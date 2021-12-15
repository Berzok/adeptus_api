<?php

namespace App\Repository;

use App\Entity\Caracteristique;
use App\Entity\Competence;
use App\Entity\CompetenceSpecialisation;
use App\Entity\Handicap;
use App\Entity\Origine;
use App\Entity\Personnage;
use App\Entity\PersonnageCaracteristiques;
use App\Entity\PersonnageCompetences;
use App\Entity\PersonnageCompetencesSpecialisations;
use App\Entity\PersonnageHandicaps;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\TransactionRequiredException;
use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\SerializationContext;

/**
 * @method Personnage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personnage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personnage[]    findAll()
 * @method Personnage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnageRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Personnage::class);
    }


    /**
     * @return Personnage
     */
    public function getEmpty(ManagerRegistry $doctrine) {

        $repositoryC = $doctrine->getRepository(Caracteristique::class);
        $empty = new Personnage();

        $empty->setImage('brain_in_jar.jpg');

        //Settings the defaults caracteristiques
        $default_car = $doctrine->getRepository(Caracteristique::class)->findAll();

        //Settings the defaults competences
        $default_com = $doctrine->getRepository(Competence::class)->findAll();

        //Settings the defaults specialisations
        $competences_carac = array(
            1 => $repositoryC->find(1),
            2 => $repositoryC->find(2),
            3 => $repositoryC->find(3),
            4 => $repositoryC->find(1),
            5 => $repositoryC->find(2),
            6 => $repositoryC->find(2),
            7 => $repositoryC->find(1),
            8 => $repositoryC->find(3),
            9 => $repositoryC->find(1),
            10 => $repositoryC->find(2)
        );
        //$default_spe = $doctrine->getRepository(CompetenceSpecialisation::class)->findAll();


        foreach ($default_car as $key => $value) {
            $pc = new PersonnageCaracteristiques();
            $pc->setCaracteristique($value);
            $empty->addCaracteristique($pc);
        }


        foreach ($default_com as $key => $value) {
            $pc = new PersonnageCompetences();
            $pc->setGroupe($value);
            $pc->setCaracteristique($competences_carac[$key + 1]);
            //$pc->setCaracteristique($key);
            $groupe_spe = $doctrine->getRepository(CompetenceSpecialisation::class)->findBy(['id_competence' => $value->getId()]);
            foreach ($groupe_spe as $clef => $spe) {
                $pcs = new PersonnageCompetencesSpecialisations();
                $pcs->setSpecialisation($spe);
                $pc->addSpecialisation($pcs);
            }
            $empty->addCompetence($pc);
        }


        $empty->setSexe('F');
        $empty->setOrigine($doctrine->getRepository(Origine::class)->find(2));

        /*
        foreach($groupe_spe as $key => $spe){
            $pcs = new PersonnageCompetencesSpecialisations();
            $pcs->setSpecialisation($spe);
            $empty->getCompetences()->add($pcs);
            $pc->setSpecialisations($spe);
        }
        */

        //dump($empty);


        return $empty;
    }


    /**
     * @throws Exception
     */
    public function getOne(int $id) {

        $em = $this->getEntityManager();
        $conn = $this->getEntityManager()->getConnection();

        $qb = $this->createQueryBuilder('p')
            ->where('p.id = :id')
            ->setParameter('id', $id);

        $query = $qb->getQuery();
        $personnage = $em->getRepository(Personnage::class)->find($id);
        //$personnage = $query->execute()[0];


        $sql = '
            SELECT id FROM
            personnage_caracteristiques
            WHERE id_personnage = :id_personnage';

        $statement = $conn->prepare($sql);
        $result = $statement->executeQuery([
            'id_personnage' => $id
        ]);

        /* @var $v PersonnageCaracteristiques */
        foreach ($result->fetchAllAssociative() as $v) {
            $p_car = $em->find(PersonnageCaracteristiques::class, $v['id']);
            $personnage->addCaracteristique($p_car);
        }


        $sql = '
            SELECT id FROM
            personnage_competences
            WHERE id_personnage = :id_personnage';

        $statement = $conn->prepare($sql);
        $result = $statement->executeQuery([
            'id_personnage' => $id
        ]);


        /* @var $v PersonnageCompetences */
        foreach ($result->fetchAllAssociative() as $v) {
            $p_comp = $em->find(PersonnageCompetences::class, $v['id']);

            $sql_specs = '
            SELECT id FROM
            personnage_competences_specialisations
            WHERE id_personnage_competences = :id_pc';

            $statement = $conn->prepare($sql_specs);
            $result = $statement->executeQuery([
                'id_pc' => $p_comp->getId()
            ]);
            foreach ($result->fetchAllAssociative() as $valeur) {
                $p_comp_spe = $em->find(PersonnageCompetencesSpecialisations::class, $valeur['id']);
                $p_comp->addSpecialisation($p_comp_spe);
                //dump($p_comp);
            }
            $personnage->addCompetence($p_comp);
        }

        //dump($personnage);


        return $personnage;


        /*
        $personnage = new Personnage();

        //Settings the defaults caracteristiques
        $default_car = $em->getRepository(Caracteristique::class)->findAll();
        foreach($default_car as $key => $value){
            $pc = new PersonnageCaracteristiques();
            $pc->setCaracteristique($value);
            $personnage->addCaracteristique($pc);
        }

        //Settings the defaults competences
        $default_com = $em->getRepository(Competence::class)->findAll();
        foreach($default_com as $key => $value){
            $pc = new PersonnageCompetences();
            $pc->setGroupe($value);
            $personnage->addCompetence($pc);
        }

        return $personnage;
        */
    }


    /**
     * @throws Exception
     */
    public function create(Personnage $personnage): mixed {

        $em = $this->getEntityManager();
        $conn = $this->getEntityManager()->getConnection();
        $conn->beginTransaction();

        $properties = $personnage->listProperties();


        //Insertion in personnage
        $sql = 'INSERT INTO personnage (id_origine, prenom, nom, sexe, image, age, taille, masse, nationalite, description, inventaire) 
                VALUES (:id_origine, :prenom, :nom, :sexe, :image, :age, :taille, :masse, :nationalite, :description, :inventaire)';

        $statement = $conn->prepare($sql);
        $result = $statement->executeQuery([
            'id_origine' => $personnage->getOrigine()->getId(),
            'prenom' => $personnage->getPrenom(),
            'nom' => $personnage->getNom(),
            'sexe' => $personnage->getSexe(),
            'image' => $personnage->getImage(),
            'age' => $personnage->getAge(),
            'taille' => $personnage->getTaille(),
            'masse' => $personnage->getMasse(),
            'nationalite' => $personnage->getNationalite(),
            'description' => $personnage->getDescription(),
            'inventaire' => $personnage->getInventaire()
        ]);

        $personnage->setId($conn->lastInsertId());

        //Extraction of data in variables
        $personnage_competences = $personnage->getCompetences();
        $personnage_caracteristiques = $personnage->getCaracteristiques();


        /* @var $v PersonnageCompetences */
        foreach ($personnage_competences as $v) {
            $sql = '
            INSERT INTO personnage_competences (id_personnage, id_competence, id_caracteristique, score, bonus)
            VALUES (:id_personnage, :id_competence, :id_caracteristique, :score, :bonus)';

            $statement = $conn->prepare($sql);
            $result = $statement->executeQuery([
                'id_personnage' => $personnage->getId(),
                'id_competence' => $v->getGroupe()->getId(),
                'id_caracteristique' => $v->getCaracteristique()->getId(),
                'score' => $v->getScore(),
                'bonus' => $v->getBonus()
            ]);
            $p_comp = $em->find(PersonnageCompetences::class, $conn->lastInsertId());

            $personnage_competences_specialisations = $v->getSpecialisations();
            /* @var $spe PersonnageCompetencesSpecialisations */
            foreach ($personnage_competences_specialisations as $spe) {
                $sql = '
                INSERT INTO personnage_competences_specialisations (id_personnage_competences, id_competence_specialisation, acquis, maitrise, bonus, score)
                VALUES (:id_personnage_competences, :id_competence_specialisation, :acquis, :maitrise, :bonus, :score)';

                $statement = $conn->prepare($sql);
                $result = $statement->executeQuery([
                    'id_personnage_competences' => $p_comp->getId(),
                    'id_competence_specialisation' => $spe->getSpecialisation()->getId(),
                    'acquis' => $spe->getAcquis(),
                    'maitrise' => $spe->getScore(),
                    'bonus' => $spe->getBonus(),
                    'score' => $spe->getScore()
                ]);
            }
        }

        /* @var $v PersonnageCaracteristiques */
        foreach ($personnage_caracteristiques as $v) {
            $sql = '
            INSERT INTO personnage_caracteristiques (id_personnage, id_caracteristique, score, score_max)
            VALUES (:id_personnage, :id_caracteristique, :score, :score_max)';

            $statement = $conn->prepare($sql);
            $result = $statement->executeQuery([
                'id_personnage' => $personnage->getId(),
                'id_caracteristique' => $v->getCaracteristique()->getId(),
                'score' => $v->getScore(),
                'score_max' => $v->getScoreMax()
            ]);
        }


        /*
        //Setting all the competences
        $competences = $personnage->getCompetences();
        foreach ($competences as $c){
            $personnage->addCompetence($c);
        }

        $caracteristiques = $data->getCaracteristiques();
        foreach ($caracteristiques as $c){
            $personnage->addCaracteristique($c);
        }
        */

        foreach ($properties as $key => $value) {
            //$personnage->{'set' . ucfirst($value) }($data->{'get' . ucfirst($value)}());
        }

        //return $personnage;
        //dump($personnage);
        //$this->getEntityManager()->persist($personnage);
        //$this->getEntityManager()->flush();

        $conn->commit();

        return $personnage;
    }


    /**
     * @param Personnage $personnage
     * @return Personnage|int
     * @throws Exception
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     */
    public function save(Personnage $personnage): Personnage{

        $em = $this->getEntityManager();
        $conn = $this->getEntityManager()->getConnection();

        //Extraction of data in variables
        $personnage_competences = $personnage->getCompetences();
        $personnage_caracteristiques = $personnage->getCaracteristiques();
        $personnage_handicaps = $personnage->getHandicaps();



        /* @var $v PersonnageHandicaps */
        foreach ($personnage_handicaps as $v) {
            $h = $em->find(Handicap::class, $v->getId());
            $personnage->removeHandicap($v);
            $personnage->addHandicap($h);
            //$em->persist($personnage);
            //$em->flush($personnage);
        }

        return $personnage;
    }

    // /**
    //  * @return Personnage[] Returns an array of Personnage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Personnage
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
