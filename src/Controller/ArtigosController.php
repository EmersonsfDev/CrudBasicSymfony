<?php
  namespace App\Controller;

  use App\Entity\Artigos;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

  use Symfony\Component\Form\Extension\Core\Type\TextType;
  use Symfony\Component\Form\Extension\Core\Type\TextareaType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;



  class ArtigosController extends AbstractController {
    /**
     * @Route("/",name="lista_de_Artigos")
     * @Method({"GET"})
     */
    public function index() {

      $artigos=$this->getDoctrine()->getRepository(Artigos::class)->findAll();

      return $this->render('artigos/index.html.twig',array('artigos'=>$artigos));
    }

      /**
       * @Route("/artigos/new", name="new_artigo")
       * Method({"GET", "POST"})
       */
      public function new(Request $request) {
          $article = new Artigos();

          $form = $this->createFormBuilder($article)
              ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
              ->add('body', TextareaType::class, array(
                  'required' => false,
                  'attr' => array('class' => 'form-control')
              ))
              ->add('save', SubmitType::class, array(
                  'label' => 'Criar',
                  'attr' => array('class' => 'btn btn-primary mt-3')
              ))
              ->getForm();

          $form->handleRequest($request);

          if($form->isSubmitted() && $form->isValid()) {
              $article = $form->getData();

              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->persist($article);
              $entityManager->flush();

              return $this->redirectToRoute('lista_de_Artigos');
          }

          return $this->render('artigos/new.html.twig', array(
              'form' => $form->createView()
          ));
      }

      /**
       *@Route("/artigo/{id}",name="exibir_artigo")
       */
      public function show($id){
          $artigo = $this->getDoctrine()->getRepository(Artigos::class)->find($id);
          return $this->render('artigos/show.html.twig',array('artigo'=>$artigo));
      }

      /**
       * @Route("/artigo/delete/{id}")
       * @Method({"DELETE"})
       */
      public function delete(Request $request, $id) {
          $artigo = $this->getDoctrine()->getRepository(Artigos::class)->find($id);

          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->remove($artigo);
          $entityManager->flush();

          $response = new Response();
          $response->send();
      }

  }
