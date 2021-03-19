<?php

namespace App\Controller;
use App\Entity\RestaurantPicture;
use App\Repository\RestaurantPictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantpictureController extends AbstractController
{
    private $restaurantpictureRepository;
    function __construct(RestaurantPictureRepository $restaurantpictureRepository)
    {
        $this->restaurantpictureRepository=$restaurantpictureRepository;
    }

    /**
     * @Route("/restaurantpicture", name="restaurantpicture")
     */
    public function index(): Response
    {
        $restaurantpicures= $this->getDoctrine()->getRepository(RestaurantPicture::class)->findAll();
        return $this->render('restaurant/index.html.twig', array('restaurants' => $restaurantpicures));
    }
    /**
     * @Route("/addrestaurantpicture", name="add_restaurantpicture", methods={"GET","POST"})
     */
    public function addRestaurantpicture(Request $request): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // get data from form
            $restaurantpicture=new RestaurantPicture();
            $restaurantpicture->setFilename($request->get('filename'));
            $restaurantpicture->setRestaurantId($request->get('restauid'));

            // persist object into database
            $this->restaurantpictureRepository->addrestaurantpicture($restaurantpicture);

            return $this->render("restaurantpic/index.html.twig");
        }else{

            return $this->render("restaurantpic/form-restaurant.html.twig");
        }

    }
    /**
     * @Route("/editrestaurantpicture/{id}", name="edit_restaurantpicture", methods={"GET","POST"})
     */
    public function editRestaurantpicture(Request $request,$id): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // fin the object to edit
            $restaurantpicture=new RestaurantPicture();
            $restaurantpicture = $this->getDoctrine()->getRepository(RestaurantPicture::class)->find($id);

            // get data from form
            $restaurantpicture->setFilename($request->get('filename'));
            $restaurantpicture->setRestaurantId($request->get('restauid'));

            // persist object into database
            $this->restaurantpictureRepository->editrestaurantpicture($restaurantpicture);

            return $this->render("restaurantpicture/index.html.twig");
        }else{

            return $this->render("restaurantpicture/form-editrestaurantpicture.html.twig");
        }

    }
    /**
     * @Route("/restaurantpicture/delete/{id}")
     */
    public function delete($id) {

        //find the object to delete
        $restaurantpicture = $this->getDoctrine()->getRepository(RestaurantPicture::class)->find($id);

        // delete object
        $this->restaurantpictureRepository->deleterestaurantpicture($restaurantpicture);
        return $this->render("restaurantpicture/index.html.twig");
    }
}