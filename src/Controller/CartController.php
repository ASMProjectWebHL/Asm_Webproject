<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;
use App\Form\RemoveItemType;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private CartRepository $repo;
    public function __construct(CartRepository $repo)
   {
      $this->repo = $repo;
   }

    /**
    * @Route("/cart", name="app_cart")
    */
   public function showCart(CartRepository $repo): Response
   {
    $user = $this->getUser();
     $carts = $repo->ShowCart($user->getId());
     $total= $repo->CartSum($user);
     return $this->render('cart/index.html.twig',[
        'carts'=>$carts,
        'total'=>$total[0]['Total']
     ]);
   }

}
