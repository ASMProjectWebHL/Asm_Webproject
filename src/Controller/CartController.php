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

   /**
    * @Route("/addcart/{id}", name="add_cart", requirements={"id"="\d+"})
    */
    public function addCart(Product $p,Request $req, CartRepository $repo): Response
    {
         $qty = $req->query->get('quantity_input');
 
         $card = new Cart();
         $card->setQuantity($qty);
         $card->setCartpro($p);
         $card->setCartuser($this->getUser());
         $repo->save($card, true);
         $this->addFlash('success','Add cart successfully');
        return $this->redirectToRoute('app_cart', [], Response::HTTP_SEE_OTHER);
    }
    

/**
     * @Route("/cart/delete/{id}", name="remove_cart")
     */
    public function deleteCart(Request $req, Cart $cart, CartRepository $repo): Response
    {
        $repo->remove($cart,true);
        return $this->redirectToRoute('app_cart');
    }
}
