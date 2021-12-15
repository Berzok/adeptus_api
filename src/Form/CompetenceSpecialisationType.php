<?php

namespace App\Form;

use App\Entity\Competence;
use App\Entity\CompetenceSpecialisation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetenceSpecialisationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('id')
            ->add('nom')
            ->add('restreinte')
            ->add('description');

        /*
            ->add('id_competence', EntityType::class, [
                'class' => Competence::class,
                'choice_value' => 'id',
                'by_reference' => false
            ])
        */
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => CompetenceSpecialisation::class,
        ]);
    }
}
