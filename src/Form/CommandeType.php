<?php

namespace App\Form;

use App\Entity\Commande;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'require'=>false,
                'label' => 'date', 
                'attr' => [
                    'placeholder' => 'Selectionne une date'
                ]
            ])
            ->add('user', Entity::class, [
                'required' => false,
                'label' => 'Utilisateur',
                'attr'=>[
                    'placeholder' => 'Sélectionne un utilisateur'
                ]
            ])
            ->add('product', EntityType::class,[
                'required'=>false,
                'label'=>'Catégorie produit',
                'attr'=>[
                    'placeholder'=>'Saissisez la catégorie du produit'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
