<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 *
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function findByAccountDBAL(string $account)
    {
        $queryBuilder = $this->getEntityManager()->getConnection()->createQueryBuilder();
        return $queryBuilder->from("(SELECT *, data ->> 'account' as account FROM event) as innerTable")
            ->select('*')
            ->where("innerTable.account = :account")
            ->setParameter('account', $account)
            ->fetchAllAssociative();
    }

    public function findByAccountORM(string $account)
    {
        $queryBuilder = $this->createQueryBuilder('e');
        return $queryBuilder->select(
            [
                'e',
                'JSON_GET_PATH_TEXT(e.data, account) as account'
            ]
        )
            ->where("account = :account")
            ->setParameter('account', $account)
            ->getQuery()
            ->getResult();
    }
}
