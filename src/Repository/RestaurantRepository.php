<?php

namespace App\Repository;
use App\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
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
        $query = $entityManager->createQuery("SELECT AVG(rv.rating) as moyenne FROM App\Entity\Review rv where rv.restaurant_id=".$id);
        return $query->getResult();
    }
    public function topThreeRestaurants()
    {
        $sql = " SELECT r.id ,r.name , r.description , r.create_at ,avg(rv.rating) as moyenne 
             FROM restaurant r INNER join review rv where rv.restaurant_id_id=r.id  GROUP BY r.id ORDER By moyenne asc limit 3";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function listRestautsWithDetails($id)
    {
        $sql = "SELECT r.id ,r.name , r.description , r.create_at,rv.user_id_id,rv.rating,rv.message,u.usrname
             FROM restaurant r INNER join review rv on rv.restaurant_id_id=r.id 
            INNER JOIN user u on rv.user_id_id=u.id where r.id=".$id
            ;
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function classRestaurantsByVot()
    {
        $sql = " SELECT r.id ,r.name , r.description , r.create_at ,avg(rv.rating) as moyenne 
             FROM restaurant r INNER join review rv where rv.restaurant_id_id=r.id  GROUP BY r.id ORDER By moyenne asc";
        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
