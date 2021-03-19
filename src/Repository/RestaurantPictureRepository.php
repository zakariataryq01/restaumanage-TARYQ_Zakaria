<?php

namespace App\Repository;

use App\Entity\Restaurant;
use App\Entity\RestaurantPicture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RestaurantPicture|null find($id, $lockMode = null, $lockVersion = null)
 * @method RestaurantPicture|null findOneBy(array $criteria, array $orderBy = null)
 * @method RestaurantPicture[]    findAll()
 * @method RestaurantPicture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantPictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RestaurantPicture::class);
    }

    public function  addrestaurantpicture($restaurantpicture)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($restaurantpicture);
        $entityManager->flush();
    }
    public function  editrestaurantpicture($restaurantpicture)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->flush();
    }
    public function deleterestaurantpicture($restaurantpicture)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($restaurantpicture);
        $entityManager->flush();
    }
}
