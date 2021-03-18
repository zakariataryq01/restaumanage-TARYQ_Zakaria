<?php

namespace App\Controller;

use App\Entity\City;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    /**
     * @Route("/city", name="city")
     */
    public function index(): Response
    {
        $cities= $this->getDoctrine()->getRepository(City::class)->findAll();
        return $this->render('city/index.html.twig', array('cities' => $cities));
    }
    /**
     * @Route("/addcity", name="add_city", methods={"GET","POST"})
     */
    public function addCity(Request $request): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // get data from form
            $city=new City();
            $city->setName($request->get('name'));
            $city->setZipcode($request->get('zipcode'));

            // persist object into database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($city);
            $entityManager->flush();

            return $this->render("city/index.html.twig");
        }else{

            return $this->render("city/form-city.html.twig");
        }

    }
    /**
     * @Route("/editcity/{id}", name="edit_city", methods={"GET","POST"})
     */
    public function editCity(Request $request,$id): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // fin the object to edit
            $city =new City();
            $city = $this->getDoctrine()->getRepository(City::class)->find($id);

            // get data from form
            $city->setName($request->get('name'));
            $city->setZipcode($request->get('zipcode'));

            // persist object into database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->render("city/index.html.twig");
        }else{

            return $this->render("city/form-editcity.html.twig");
        }

    }
    /**
     * @Route("/city/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {

        //find the object to delete
        $city = $this->getDoctrine()->getRepository(City::class)->find($id);

        // delete object
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($city);
        $entityManager->flush();
        return $this->render("city/index.html.twig");
    }

}
