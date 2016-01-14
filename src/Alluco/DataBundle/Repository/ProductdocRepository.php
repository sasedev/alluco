<?php

namespace Alluco\DataBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Alluco\DataBundle\Entity\Product;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class ProductdocRepository extends EntityRepository
{

    /**
     * All count
     *
     * @return Ambigous <\Doctrine\ORM\mixed, mixed, multitype:,
     *         \Doctrine\DBAL\Driver\Statement, \Doctrine\Common\Cache\mixed>
     */
    public function count()
    {
        $qb = $this->createQueryBuilder('pd')->select('count(pd)');
        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }

    /**
     * Get Query for All Entities
     *
     * @return \Doctrine\ORM\Query
     */
    public function getAllQuery()
    {
        $qb = $this->createQueryBuilder('pd')
            ->join('pd.product', 'p')
            ->orderBy('p.rank', 'DESC')
            ->addOrderBy('pd.rank', 'DESC');
        $query = $qb->getQuery();

        return $query;
    }

    /**
     * Get All Entities
     *
     * @return Ambigous <\Doctrine\ORM\mixed,
     *         \Doctrine\ORM\Internal\Hydration\mixed,
     *         \Doctrine\DBAL\Driver\Statement,
     *         \Doctrine\Common\Cache\mixed>
     */
    public function getAll()
    {
        return $this->getAllQuery()->execute();
    }

    /**
     * All count
     *
     * @return Ambigous <\Doctrine\ORM\mixed, mixed, multitype:,
     *         \Doctrine\DBAL\Driver\Statement, \Doctrine\Common\Cache\mixed>
     */
    public function countByProduct(Product $prod)
    {
        $qb = $this->createQueryBuilder('pd')->select('count(pd)')
            ->join('pd.product', 'p')
            ->where('p = :p')
            ->setParameter('p', $prod);
        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }

    /**
     * Get Query for All Entities
     *
     * @return \Doctrine\ORM\Query
     */
    public function getAllByProductQuery(Product $prod)
    {
        $qb = $this->createQueryBuilder('pd')
            ->join('pd.product', 'p')
            ->where('p = :p')
            ->orderBy('pd.rank', 'DESC')
            ->setParameter('p', $prod);
        $query = $qb->getQuery();

        return $query;
    }

    /**
     * Get All Entities
     *
     * @return Ambigous <\Doctrine\ORM\mixed,
     *         \Doctrine\ORM\Internal\Hydration\mixed,
     *         \Doctrine\DBAL\Driver\Statement,
     *         \Doctrine\Common\Cache\mixed>
     */
    public function getAllByProduct(Product $prod)
    {
        return $this->getAllByProductQuery($prod)->execute();
    }
}