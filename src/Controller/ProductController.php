<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Manager\CartManager;
use App\Manager\Manager;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    private ProductRepository $repo;
    public function __construct(ProductRepository $repo)
   {
      $this->repo = $repo;
   }
    /**
     * @Route("/show", name="product_show")
     */
    public function readAllAction(): Response
    {
        $products = $this->repo->findAll();
        return $this->render('product/index.html.twig', [
            'products'=>$products
        ]);
    }

     /**
     * @Route("/{id}", name="product_read",requirements={"id"="\d+"})
     */
    public function showAction(Product $p): Response
    {
        return $this->render('detail.html.twig', [
            'p'=>$p
        ]);

    }


  
}
