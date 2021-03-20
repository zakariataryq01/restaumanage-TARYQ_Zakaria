<?php

namespace App\Controller;
use App\Entity\City;
use App\Entity\Restaurant;
use App\Repository\CityRepository;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    private $restaurantRepository;
    private $cityRepository;
    private $session;
    function __construct(RestaurantRepository $restaurantRepository,CityRepository $cityRepository ,SessionInterface $session)
    {
        $this->restaurantRepository=$restaurantRepository;
        $this->cityRepository=$cityRepository;
        $this->session=$session;
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
    * @Route("/addrestaurant", name="addrestaurant", methods={"GET","POST"})
    */
    public function addRestaurant(Request $request): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // get data from form
            $restaurant=new Restaurant();
            $restaurant->setDescription($request->get('description'));
            $restaurant->setName($request->get('name'));
            $restaurant->setCityId($this->cityRepository->find($request->get('city')));

            $restaurant->setCreateAt(new \DateTime());
            // persist object into database
            $this->restaurantRepository->addrestaurant($restaurant);

            // add alert success
            $this->session->getFlashBag()->add(
                'success',
                'your abject has been added with success !'
            );
            //redirect to index
            return $this->redirectToRoute('restaurant');

        }else{
            $cities=$this->cityRepository->findAll();
            return $this->render("restaurant/form-restaurant.html.twig",[
                'cities'=>$cities
            ]);
        }

    }
    /**
     * @Route("/editrestaurant/{id}", name="editrestaurant", methods={"GET","POST"})
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
            $restaurant->setCityId($this->cityRepository->find($request->get('city')));

            // persist object into database
            $this->restaurantRepository->editrestaurant($restaurant);

            // add alert success
            $this->session->getFlashBag()->add(
                'success',
                'your abject has been updated with success !'
            );
            //redirect to index
            return $this->redirectToRoute('restaurant');
        }else{
            $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);
            $cities=$this->cityRepository->findAll();
            return $this->render("restaurant/form-editrestaurant.html.twig",[
                'restaurant'=>$restaurant,
                'cities'=>$cities
            ]);
        }

    }
    /**
     * @Route("/deleterestaurant/{id}")
     */
    public function delete($id) {

        //find the object to delete
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);

        // delete object
        $this->restaurantRepository->deleterestaurant($restaurant);

        // add alert success
        $this->session->getFlashBag()->add(
            'success',
            'your abject has been deleted with success !'
        );
        //redirect to index
        return $this->redirectToRoute('restaurant');
    }
    /**
     * @Route("/show/{id}")
     */
    public function showRestaurant($id)
    {
        $reviews=$this->restaurantRepository->listRestautsWithDetails($id);
        //find the object to show
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);
        $city=$this->getDoctrine()->getRepository(City::class)->find($restaurant->getCityId());

        return $this->render("restaurant/showRestaurant.html.twig",[
            'restaurant'=> $restaurant,
            'reviews'=>$reviews,
            'city'=>$city
            ]);
      }
    /**
     * @Route("/requestdql", name="requestdql")
     */
    public function viewDQL(): Response
    {

        $reviews=$this->restaurantRepository->listRestautsWithDetails(7);
        //find the object to show
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find(7);
        $city=$this->getDoctrine()->getRepository(City::class)->find($restaurant->getCityId());

        $restaus=$this->restaurantRepository->listnewRestaurant();
        $valMoy=$this->restaurantRepository->AvgNoteRestaurant(7);
        $topThreeRestaurants=$this->restaurantRepository->topThreeRestaurants();
        return $this->render('restaurant/requestsDql-view.html.twig',[
            'restaurants'=>$restaus,
            'valeurMoyenne'=>$valMoy,
            'topThreeRestaurants'=>$topThreeRestaurants,
            'reviews'=>$reviews,
            'restaurant'=>$restaurant,
            'city'=>$city
        ]);
    }
}
