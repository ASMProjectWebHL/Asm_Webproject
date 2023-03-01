<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditproType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\String\Slugger\SluggerInterface;

class EditproController extends AbstractController
{
    private UserRepository $repo;
    public function __construct(UserRepository $repo)
   {
      $this->repo = $repo;
   }
       /**
     * @Route("/editpro", name="editprofile")
     */
    public function editproAction(Request $req): Response
    {
        $u = $this->getUser();
        
        $form = $this->createForm(EditproType::class, $u);   

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            
            $this->repo->save($u,true);
            $this->addFlash('success','You have successfully updated your profile!');
            return $this->redirectToRoute('editprofile', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("editpro/index.html.twig",[
            'form' => $form->createView()
        ]);
    }
}
