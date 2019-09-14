<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Taxe;
use App\Entity\User;
use App\Entity\Depot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class, ["label" => "nom du produit", 
        "attr" => [
            'class' => "form-control",
            'placeholder' => "Enter product name "
            ]
            ])
        ->add('price', NumberType::class, ["label" => "prix", "attr" => ['class' => "form-control"]])

        ->add('category', EntityType::class, [
            // looks for choices from this entity
            'class' => Category::class,
        
            // uses the User.username property as the visible option string
            'choice_label' => 'name',
            "label" => "nom du category", 
            "attr" => ['class' => "form-control"],
            'placeholder' => "Shoose  category ..."
            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,
        ])

        ->add('user', EntityType::class, [
            // looks for choices from this entity
            'class' => User::class,
        
            // uses the User.username property as the visible option string
            'choice_label' => 'name',
            "label" => "nom de  l'utilisateur", 
            "attr" => ['class' => "form-control"],
            'placeholder' => "Shoose user ..."
            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,
        ])

        ->add('taxes', EntityType::class, [
            // looks for choices from this entity
            'class' => Taxe::class,
            'multiple' => true,
            // uses the User.username property as the visible option string
            'choice_label' => 'name',
            "label" => "Taxe ", 
            "attr" => [
                'class' => "form-control selectpicker",
                'multiple' => true
            ],
            'placeholder' => "Shoose taxe ..."
            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,
        ])

        ->add('depots', EntityType::class, [
            // looks for choices from this entity
            'class' => Depot::class,
            'multiple' => true,
            // uses the User.username property as the visible option string
            'choice_label' => 'name',
            "label" => "Depots ", 
            "attr" => [
                'class' => "form-control selectpicker",
                'multiple' => true
            ],
            'placeholder' => "Shoose depots ..."
            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,
        ])

        ->add('type', ChoiceType::class, [
            'choices'  => [
                'Product' => 0,
                'Service' => 1
            ],

            "label" => "Type ", 
            "attr" => [
                'class' => "form-control selectpicker"
            ],
            'placeholder' => "Shose type ..."
        ])
        ->add('save', SubmitType::class, array('label' => 'Create Product', "attr" => ['class' => "btn btn-primary"]))
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
