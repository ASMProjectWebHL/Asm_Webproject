<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class DefaultController extends AbstractController
{
    /**
    * @Route("/contact", name="app_contact")
    */
  public function createAction(Request $request)
   {
      $contact = new Contact();     
     # Add form fields
       $form = $this->createFormBuilder($contact)
       ->add('name', TextType::class, array('label'=> 'name', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
       ->add('email', TextType::class, array('label'=> 'email','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
       ->add('topic', TextType::class, array('label'=> 'topic','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
       ->add('message', TextareaType::class, array('label'=> 'message','attr' => array('class' => 'form-control')))
       ->add('Save', SubmitType::class, array('label'=> 'submit', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-top:15px')))
       ->getForm();
     # Handle form response
       $form->handleRequest($request);
       # check if form is submitted 
       if($form->isSubmitted() &&  $form->isValid()){
        $name = $form['name']->getData();
        $email = $form['email']->getData();
        $subject = $form['topic']->getData();
        $message = $form['message']->getData(); 
  # set form data   
        $contact->setName($name);
        $contact->setEmail($email);          
        $contact->setTopic($subject);     
        $contact->setMessage($message);                
   # finally add data in database
        $sn = $this->getDoctrine()->getManager();      
        $sn -> persist($contact);
        $sn -> flush();

        $this->addFlash('success', sprintf('Hi %s, you have successfully submitted the contact form to us!', $name));
        return $this->redirectToRoute('app_contact', [], Response::HTTP_SEE_OTHER);
   }
   return $this->render('default/index.html.twig', [
    'form' => $form->createView()
]);

}
}