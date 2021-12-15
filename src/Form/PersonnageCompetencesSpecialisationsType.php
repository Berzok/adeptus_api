<?php

namespace App\Form;

use App\Entity\PersonnageCompetences;
use App\Entity\PersonnageCompetencesSpecialisations;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnageCompetencesSpecialisationsType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('id')
            ->add('acquis')
            ->add('maitrise')
            ->add('score')
            ->add('bonus')
            ->add('specialisation', CompetenceSpecialisationType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => PersonnageCompetencesSpecialisations::class,
        ]);
    }
}
