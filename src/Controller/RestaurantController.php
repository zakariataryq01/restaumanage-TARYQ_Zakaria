<?php

namespace App\Controller;
use App\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    /**
     * @Route("/restaurant", name="restaurant")
     */
    public function index(): Response
    {
        $restaurants= $this->getDoctrine()->getRepository(Restaurant::class)->findAll();
        return $this->render('restaurant/index.html.twig', array('restaurants' => $restaurants));
    }
    /**
    * @Route("/addrestaurant", name="add_restaurant", methods={"GET","POST"})
    */
    public function addRestaurant(Request $request): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // get data from form
            $restaurant=new Restaurant();
            $restaurant->setDescription($request->get('description'));
            $restaurant->setName($request->get('name'));
            $restaurant->setCityId($request->get('city'));

            // persist object into database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($restaurant);
            $entityManager->flush();

            return $this->render("restaurant/index.html.twig");
        }else{

            return $this->render("restaurant/form-restaurant.html.twig");
        }

    }
    /**
     * @Route("/editrestaurant/{id}", name="edit_restaurant", methods={"GET","POST"})
     */
    public function editRestaurant(Request $request,$id): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // fin the object to edit
            $restaurant=new Restaurant();
            $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);

            // get data from form
            $restaurant->setDescription($request->get('description'));
            $restaurant->setName($request->get('name'));
            $restaurant->setCityId($request->get('city'));

            // persist object into database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->render("restaurant/index.html.twig");
        }else{

            return $this->render("restaurant/form-editrestaurant.html.twig");
        }

    }
    /**
     * @Route("/restaurant/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {

        //find the object to delete
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);

        // delete object
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($restaurant);
        $entityManager->flush();
        return $this->render("restaurant/index.html.twig");
    }

}
