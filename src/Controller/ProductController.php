<?php
// src/App/Controller/DefaultController.php
namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Taxe;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProductRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 *@Route("/product", name="product")
 */
class ProductController extends Controller
{
    /**
     *   @Route("/", name="_index")
     */

    public function index(ProductRepository $productrepository)
    {
        $product = $productrepository->findAll();
        return $this->render('product/index.html.twig', ['products' => $product]);
    }

    /**
     *   @Route("/delete/{id}", name="_delete")
     */

    public function delete(Product $id)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($id);
        $entityManager->flush();
        return $this->redirectToRoute('product_index');

    }

/**
 *   @Route("/new", name="_new")
 */

    function new(Request $request) {
        $product = new Product();

        $form = $this->createFormBuilder($product)
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
                "attr" => ['class' => "form-control"],
                'placeholder' => "Shoose taxe ..."
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])


            ->add('save', SubmitType::class, array('label' => 'Create Product', "attr" => ['class' => "btn btn-primary"]))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
 *   @Route("/edit/{product}", name="_edit")
 */

function edit(Request $request,Product $product) {

    $form = $this->createFormBuilder($product)
        ->add('name', TextType::class, ["label" => "nom du produit", "attr" => ['class' => "form-control"]])
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
            "label" => "Taxes ", 
            "attr" => ['class' => "form-control"],
            'placeholder' => "Shoose taxe ..."
            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,
        ])
        ->add('save', SubmitType::class, array('label' => 'Edit Product', "attr" => ['class' => "btn btn-primary"]))
        ->getForm();
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();
        return $this->redirectToRoute('product_index');
    }

    return $this->render('product/new.html.twig', array(
        'form' => $form->createView(),
    ));
}

/**
 * @Route("/show/{id}", name="_show")
 */
    public function show(Product $id)
    {

        if (!$id) {
            throw $this->createNotFoundException(
                'No productfound for id ' . $id
            );
        }

        return $this->render('product/show.html.twig', [
            'product' => $id

        ]);

    }

}
