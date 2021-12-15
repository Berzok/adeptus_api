<?php

namespace App\Form;

use App\Entity\Caracteristique;
use App\Entity\Competence;
use App\Entity\PersonnageCompetences;
use App\Entity\PersonnageCompetencesSpecialisations;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnageCompetencesType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('id')
            ->add('score')
            ->add('bonus')
            ->add('groupe', CompetenceType::class);

        $builder->add('caracteristique', CaracteristiqueType::class);

        $builder->add('specialisations', CollectionType::class, [
            'entry_type' => PersonnageCompetencesSpecialisationsType::class,
            'allow_add' => true,
            'by_reference' => false,
            'mapped' => true
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => PersonnageCompetences::class,
        ]);
    }
}
