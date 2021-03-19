<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        $users= $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('user/index.html.twig', array('cities' => $users));
    }
    /**
     * @Route("/adduser", name="add_user", methods={"GET","POST"})
     */
    public function addUser(Request $request): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // get data from form
            $user=new User();
            $user->setUsrname($request->get('username'));
            $user->setPassword($request->get('password'));
            $user->setCityId($request->get('cityid'));


            // persist object into database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->render("user/index.html.twig");
        }else{

            return $this->render("user/form-user.html.twig");
        }

    }
    /**
     * @Route("/edituser/{id}", name="edit_user", methods={"GET","POST"})
     */
    public function editUser(Request $request,$id): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // fin the object to edit
            $user =new User();
            $user = $this->getDoctrine()->getRepository(User::class)->find($id);

            // get data from form
            $user->setPassword($request->get('password'));
            $user->setCityId($request->get('cityid'));


            // persist object into database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->render("user/index.html.twig");
        }else{

            return $this->render("user/form-edituser.html.twig");
        }
    }
    /**
     * @Route("/user/delete/{id}")
     */
    public function delete($id) {

        //find the object to delete
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        // delete object
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();
        return $this->render("user/index.html.twig");
    }

}
