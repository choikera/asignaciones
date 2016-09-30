<?php

namespace SisUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use SisUserBundle\Entity\Users1;
use SisUserBundle\Form\Users1Type;


class UserController extends Controller
{
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $users= $em->getRepository('SisUserBundle:Users1')->findall();
       /* $res = 'Lista de usuarios: <br />';
        foreach($users as $user)
        {
        	$res.='Usuario: '.$user->getUserName().'- Nombre: '.$user->getFirstName() . '<br />';
        }
        return new Response($res);*/
        return $this->render('SisUserBundle:User:index.html.twig',array('users' => $users));

    }
    public function viewAction($id)
    {
        $repository=$this->getDoctrine()->getManager()->getRepository('SisUserBundle:users1');
        $user= $repository->find($id);
        $user= $repository->findOneByUserName($id);
        return new Response($user->getUserName());

    }    

    public function articulosAction($page)
    {
        return new Response('Un Articulo'.$page);
    }

    public function addAction()
    {
      $user = new Users1();
      $form = $this->CreateForm(Users1Type::class,$user,array(
            'action' => $this->generateUrl('sis_user_create'),
            'method' => 'POST'));
      return $this->render('SisUserBundle:User:add.html.twig', array('form' => $form->createView()));

    }    

   
    public function formAction() {

        $user = new Users1();
        $form = $this->createForm(Users1Type::class,$user,array(
            'action' => $this->generateUrl('sis_user_create'),
            'method' => 'POST'));
        return $this->render('SisUserBundle:User:form.html.twig', array('form' => $form->createView()));
    }
    
    public function createAction(Request $request) 
    {
        $user= new Users1();
        $form = $this->createForm(Users1Type::class,$user,array(
            'action' => $this->generateUrl('sis_user_create'),
            'method' => 'POST'));
        $form->handleRequest($request);
        if($form->isValid())
        { 
            $password = $form->get('password')->getData();
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user,$password);
            $user->setPassword($encoded);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('sis_user_index');

        }
        return $this->render('SisUserBundle:User:add.html.twig', array('form' => $form->createView()));

    }

        
}
