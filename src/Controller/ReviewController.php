<?php

namespace App\Controller;

use App\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    /**
     * @Route("/review", name="review")
     */
    public function index(): Response
    {
        $reviews= $this->getDoctrine()->getRepository(Review::class)->findAll();
        return $this->render('review/index.html.twig', array('reviews' => $reviews));
    }
    /**
     * @Route("/addreview", name="add_review", methods={"GET","POST"})
     */
    public function addReview(Request $request): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // get data from form
            $review=new Review();
            $review->setMessage($request->get('message'));
            $review->setRating($request->get('rating'));
            $review->setRestaurantId($request->get('restaurantid'));
            $review->setUserId($request->get('userid'));


            // persist object into database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($review);
            $entityManager->flush();

            return $this->render("review/index.html.twig");
        }else{

            return $this->render("review/form-review.html.twig");
        }

    }
    /**
     * @Route("/editreview/{id}", name="edit_review", methods={"GET","POST"})
     */
    public function editReview(Request $request,$id): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // fin the object to edit
            $review=new Review();
            //$review = $this->getDoctrine()->getRepository(Review::class)->find($id);

            // get data from form
            $review->setMessage($request->get('message'));
            $review->setRating($request->get('rating'));

            // persist object into database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->render("review/index.html.twig");
        }else{

            return $this->render("review/form-editreview.html.twig");
        }

    }
    /**
     * @Route("/review/delete/{id}")
     */
    public function delete($id) {

        //find the object to delete
        $review = $this->getDoctrine()->getRepository(Review::class)->find($id);

        // delete object
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($review);
        $entityManager->flush();
        return $this->render("review/index.html.twig");
    }

}
