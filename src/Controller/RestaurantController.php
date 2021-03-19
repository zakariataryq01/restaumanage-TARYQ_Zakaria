<?php

namespace App\Controller;
use App\Entity\Restaurant;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    private $restaurantRepository;
    function __construct(RestaurantRepository $restaurantRepository)
    {
        $this->$restaurantRepository=$restaurantRepository;
    }

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
            $this->restaurantRepository->addrestaurant($restaurant);

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
            $this->restaurantRepository->editrestaurant($restaurant);

            return $this->render("restaurant/index.html.twig");
        }else{

            return $this->render("restaurant/form-editrestaurant.html.twig");
        }

    }
    /**
     * @Route("/restaurant/delete/{id}")
     */
    public function delete($id) {

        //find the object to delete
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);

        // delete object
        $this->restaurantRepository->deleterestaurant($restaurant);
        return $this->render("restaurant/index.html.twig");
    }
    /**
     * @Route("/restaurant//{id}")
     */
    public function showRestaurant($id) {
        //find the object to show
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);
        return $this->render("restaurant/index.html.twig",[
            'restaurant'=> $restaurant
            ]);
    }
}
