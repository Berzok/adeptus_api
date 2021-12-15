<?php

namespace App\Form;

use App\Entity\Origine;
use App\Entity\Personnage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonnageType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('id')
            ->add('prenom')
            ->add('nom')
            ->add('sexe')
            ->add('image')
            ->add('age')
            ->add('taille')
            ->add('masse')
            ->add('nationalite')
            ->add('description')
            ->add('inventaire')
            ->add('origine', OrigineType::class);


        /*
        $builder->add('origine', EntityType::class, [
            'class' => Origine::class,
            'choice_value' => 'id',
            'by_reference' => false,
            'mapped' => true,
            'empty_data' => 1
        ]);
        */


        $builder->add('competences', CollectionType::class, [
            'entry_type' => PersonnageCompetencesType::class,
            'allow_add' => true,
            'by_reference' => false,
            'mapped' => true
        ]);

        $builder->add('caracteristiques', CollectionType::class, [
            'entry_type' => PersonnageCaracteristiqueType::class,
            'allow_add' => true
        ]);

        $builder->add('handicaps', CollectionType::class, [
            'entry_type' => HandicapType::class,
            'allow_add' => true
        ]);
        $builder->add('atouts', CollectionType::class, [
            'entry_type' => AtoutType::class,
            'allow_add' => true
        ]);

    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Personnage::class
        ]);
    }
}
