<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Commande;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if($options['create']==true){
        // Champ pour le titre de l'œuvre
        $builder
            ->add('title', TextType::class,[
                'required'=>false,
                'label'=>'Titre de l\'oeuvre',
                'attr'=>[
                    'placeholder'=>'Saisissez le titre de l\'oeuvre'
                ]
            ])
            // Champ d'upload de fichier pour la photo de l'œuvre
            ->add('picture_src', FileType::class, [
                'required'=>false,
                'label'=>'Photo de l\'oeuvre',
                'constraints'=> [
                    new File([
                        'mimeTypes'=>[
                            "image/png",
                            "image/jpg",
                            "image/jpeg",
                        ],
                        'mimeTypesMessage'=>"Extensions acceptées : png, jpg et jpeg"
                        
                    ])
                ]
            ])
            // Champ pour le nom de l'image
            ->add('picture_name', TextType::class,[
                'required'=>false,
                'label'=>'Nom de l\'image',
                'attr'=>[
                    'placeholder'=>'Saisissez le nom de l\'image'
                ]
            ])
            // Champ pour le prix du produit
            ->add('price', NumberType::class, [
                'required'=>false,
                'label'=>'Prix du produit',
                'attr'=>[
                    'placerholder'=>"Saisissez le prix du produit"
                ]
            ])
            // Case à cocher pour indiquer la disponibilité
            ->add('disponibility', CheckboxType::class, [
                'required'=>false,
                'label'=>'Disponibilité',
                'attr'=>[
                    'placeholder'=>'Saisissez votre disponibilité'
                ]
            ])
            // Champ pour la description de l'œuvre
            ->add('description', TextType::class,[
                'required'=>false,
                'label'=>'Description de l\'oeuvre',
                'attr'=>[
                    'placeholder'=>'Saisissez la description de l\'oeuvre'
                ]
            ])
            // Menu déroulant pour sélectionner les catégories associées
            ->add('category', EntityType::class, [
                'class'=>Category::class,
                'label'=>'Catégorie',
                'choice_label'=>'name',
                'multiple'=>true,
                'attr'=>[
                    'placeholder'=>'Saisissez les catégories en liens avec l\'oeuvre'
                ]
            ])
            // Bouton de soumission
            ->add('Valider', SubmitType::class )
        ;

        } elseif ($options['update']==true){
            $builder
            ->add('title', TextType::class,[
                'required'=>false,
                'label'=>'Titre de l\'oeuvre',
                'attr'=>[
                    'placeholder'=>'Saisissez le titre de l\'oeuvre'
                ]
            ])
            // Champ d'upload de fichier pour la photo de l'œuvre
            ->add('picture_src', FileType::class, [
                'required'=>false,
                'label'=>'Photo de l\'oeuvre',
                'constraints'=> [
                    new File([
                        'mimeTypes'=>[
                            "image/png",
                            "image/jpg",
                            "image/jpeg",
                        ],
                        'mimeTypesMessage'=>"Extensions acceptées : png, jpg et jpeg"
                        
                    ])
                ]
            ])
            // Champ pour le nom de l'image
            ->add('picture_name', TextType::class,[
                'required'=>false,
                'label'=>'Nom de l\'image',
                'attr'=>[
                    'placeholder'=>'Saisissez le nom de l\'image'
                ]
            ])
            // Champ pour le prix du produit
            ->add('price', NumberType::class, [
                'required'=>false,
                'label'=>'Prix du produit',
                'attr'=>[
                    'placerholder'=>"Saisissez le prix du produit"
                ]
            ])
            // Case à cocher pour indiquer la disponibilité
            ->add('disponibility', CheckboxType::class, [
                'required'=>false,
                'label'=>'Disponibilité',
                'attr'=>[
                    'placeholder'=>'Saisissez votre disponibilité'
                ]
            ])
            // Champ pour la description de l'œuvre
            ->add('description', TextType::class,[
                'required'=>false,
                'label'=>'Description de l\'oeuvre',
                'attr'=>[
                    'placeholder'=>'Saisissez la description de l\'oeuvre'
                ]
            ])
            // Menu déroulant pour sélectionner la commande associée
            ->add('commande', EntityType::class, [
                'class' => Commande::class, 
                'label' => 'Commande associée',
                'multiple' => false, 
                'attr' => [
                    'placeholder' => 'Sélectionnez la commande associée à l\'oeuvre'
                ]
            ])
            // Menu déroulant pour sélectionner les catégories associées
            ->add('category', EntityType::class, [
                'class'=>Category::class,
                'label'=>'Catégorie',
                'choice_label'=>'name',
                'multiple'=>true,
                'attr'=>[
                    'placeholder'=>'Saisissez les catégories en liens avec l\'oeuvre'
                ]
            ])
            // Bouton de soumission
            ->add('Valider', SubmitType::class )
            ;
            }

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'create'=>false,
            'update'=>false
        ]);
    }
}
