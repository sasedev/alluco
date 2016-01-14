<?php

namespace Alluco\DataBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Alluco\DataBundle\Entity\Product;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class ProductpicRepository extends EntityRepository
{

    /**
     * All count
     *
     * @return Ambigous <\Doctrine\ORM\mixed, mixed, multitype:,
     *         \Doctrine\DBAL\Driver\Statement, \Doctrine\Common\Cache\mixed>
     */
    public function count()
    {
        $qb = $this->createQueryBuilder('pp')->select('count(pp)');
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
        $qb = $this->createQueryBuilder('pp')
            ->join('pp.product', 'p')
            ->orderBy('p.rank', 'DESC')
            ->addOrderBy('pp.rank', 'DESC');
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
        $qb = $this->createQueryBuilder('pp')->select('count(pp)')
            ->join('pp.product', 'p')
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
        $qb = $this->createQueryBuilder('pp')
            ->join('pp.product', 'p')
            ->where('p = :p')
            ->orderBy('pp.rank', 'DESC')
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