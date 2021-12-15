<?php

namespace App\Form;

use App\Entity\Caracteristique;
use App\Entity\PersonnageCaracteristiques;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnageCaracteristiqueType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('id')
            ->add('score')
            ->add('score_max')
            ->add('caracteristique', CaracteristiqueType::class);
            //->add('id_personnage', TextType::class, ['empty_data' => 1]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => PersonnageCaracteristiques::class,
        ]);
    }
}
