<?php

namespace App\Repository;
use App\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Restaurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaurant[]    findAll()
 * @method Restaurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Restaurant::class);
    }
    public function  addrestaurant($restaurant)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($restaurant);
        $entityManager->flush();
    }
    public function  editrestaurant($restaurant)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->flush();
    }
    public function deleterestaurant($restaurant)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($restaurant);
        $entityManager->flush();
    }
    public function listnewRestaurant()
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery("SELECT r FROM App\Entity\Restaurant r order By r.create_at Desc ")
            ->setMaxResults(6);
        return $query->getResult();
    }

    public function AvgNoteRestaurant($id)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery("SELECT avg(rv.rating) FROM App\Entity\Review rv ");
        return $query->getResult();
    }
}
