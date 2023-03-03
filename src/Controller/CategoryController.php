<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryController extends AbstractController
{
    private CategoryRepository $repo;
    public function __construct(CategoryRepository $repo)
   {
      $this->repo = $repo;
   }
    /**
     * @Route("/category", name="category_show")
     */
    public function readAllAction(): Response
    {
        $categorys = $this->repo->findAll();
        return $this->render('category/index.html.twig', [
            'cate'=>$categorys
        ]);
    }

        /**
     * @Route("/addcategory", name="category_create")
     */
    public function createAction(Request $req, SluggerInterface $slugger): Response
    {
        
        $c = new Category();
        $form = $this->createForm(CategoryType::class, $c);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $this->repo->save($c,true);
            $this->addFlash('success','You have successfully updated your profile!');
            return $this->redirectToRoute('category_create', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("category/form.html.twig",[
            'form' => $form->createView()
        ]);
    }


}
