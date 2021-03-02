<?php
  namespace App\Controller;

  use App\Entity\Artigos;
  use ContainerEX0FeX9\EntityManager_9a5be93;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  
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
     *@Route("/artigo/{id}",name="exibir_artigo")
     */
    public function show($id){
        $artigo = $this->getDoctrine()->getRepository(Artigos::class)->find($id);
        return $this->render('artigos/show.html.twig',array('artigo'=>$artigo));
    }


  }    
