<?php

namespace App\Form;

use App\Entity\Doccument;
use App\Entity\User;
use App\Entity\Depot;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use App\Repository\ProductRepository;

class DoccumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', EntityType::class, [
                // looks for choices from this entity
                'class' => User::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
                "label" => "User ", 
                "attr" => [
                    'class' => "form-control selectpicker",
                ],
                'placeholder' => "Shoose user ..."
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('depot', EntityType::class, [
                // looks for choices from this entity
                'class' => Depot::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
                "label" => "Depots ", 
                "attr" => [
                    'class' => "form-control selectpicker",
                ],
                'placeholder' => "Shoose depots ..."
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('product', EntityType::class, [
                // looks for choices from this entity
                'class' => Product::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
                "label" => "Product ", 
                "attr" => [
                    'class' => "form-control selectpicker",
                ],
                'placeholder' => "Shoose product ...",
                'query_builder' => function(ProductRepository $repo) use ($options) {
                    return $repo->findProductsByType($options['type']);
                }
  
            ])
            ->add('quantity', NumberType::class, ["label" => "Quantity", "attr" => ['class' => "form-control"]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Doccument::class,
            'type' => 0
        ]);
    }
}
