<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="app_product")
     */
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'nombre_controlador' => 'Producto nuevo',
        ]);
    }

    /**
     * @Route("/product/create", name="new_product")
     */

    public function create() : Response {
        
        $entityManager = $this->getDoctrine()->getManager();

        $producto = new Product();
        $producto->setName('Pera');
        $producto->setPrice(200.5);
        $producto->setDescription('Peras riojanas');

        $entityManager->persist($producto);
      
        $entityManager->flush();

        return new Response('El identificador del producto es: '.$producto->getId());
    }

    /**
     * @Route("/product/list", name="list_product")
     */

    public function list(){

        $repository = $this->getDoctrine()->getRepository(Product::class);
        $productos = $repository->findAll();
    
        return $this->render('product/list.html.twig', [
            'productos'=> $productos
        ]);

    }

}
