<?php
// src/App/Controller/DefaultController.php
namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Taxe;
use App\Entity\User;
use App\Entity\Depot;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProductRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\ProductType;

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

        $form = $this->createForm(ProductType::class, $product);
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

    $form = $this->createForm(ProductType::class, $product);
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
