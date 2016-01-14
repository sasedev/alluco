<?php

namespace Alluco\DataBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Alluco\DataBundle\Entity\Product;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class ProductRepository extends EntityRepository
{

    /**
     * All count
     *
     * @return Ambigous <\Doctrine\ORM\mixed, mixed, multitype:,
     *         \Doctrine\DBAL\Driver\Statement, \Doctrine\Common\Cache\mixed>
     */
    public function count()
    {
        $qb = $this->createQueryBuilder('p')->select('count(p)');
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
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.rank', 'DESC');
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
    public function countRoots()
    {
        $qb = $this->createQueryBuilder('p')->select('count(p)')->where('p.productParent is NULL');
        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }

    /**
     * Get Query for All Entities
     *
     * @return \Doctrine\ORM\Query
     */
    public function getRootsQuery()
    {
        $qb = $this->createQueryBuilder('p')
            ->where('p.productParent is NULL')
            ->orderBy('p.rank', 'DESC');
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
    public function getRoots()
    {
        return $this->getRootsQuery()->execute();
    }

    /**
     * All count
     *
     * @return Ambigous <\Doctrine\ORM\mixed, mixed, multitype:,
     *         \Doctrine\DBAL\Driver\Statement, \Doctrine\Common\Cache\mixed>
     */
    public function countByProduct(Product $parent)
    {
        $qb = $this->createQueryBuilder('p')->select('count(p)')
            ->join('p.productParent', 'pp')
            ->where('pp = :pp')
            ->setParameter('pp', $parent);
        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }

    /**
     * Get Query for All Entities
     *
     * @return \Doctrine\ORM\Query
     */
    public function getAllByProductQuery(Product $parent)
    {
        $qb = $this->createQueryBuilder('p')
            ->join('p.productParent', 'pp')
            ->where('pp = :pp')
            ->orderBy('p.rank', 'DESC')
            ->setParameter('pp', $parent);
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
    public function getAllByProduct(Product $parent)
    {
        return $this->getAllByProductQuery($parent)->execute();
    }

    /**
     * Search count
     *
     * @return Ambigous <\Doctrine\ORM\mixed, mixed, multitype:,
     *         \Doctrine\DBAL\Driver\Statement, \Doctrine\Common\Cache\mixed>
     */
    public function countSearch($q)
    {

        $qb = $this->createQueryBuilder('p')->select('count(p)')->distinct()
            ->leftJoin('p.i18ns', 'trans')
            ->where('LOWER(p.name) LIKE :key')
            ->orWhere('LOWER(p.name) LIKE :key')
            ->orWhere('LOWER(p.metaTitle) LIKE :key')
            ->orWhere('LOWER(p.metaKeywords) LIKE :key')
            ->orWhere('LOWER(p.metaDescription) LIKE :key')
            ->orWhere('LOWER(p.pageTitle) LIKE :key')
            ->orWhere('LOWER(p.breadcrumb) LIKE :key')
            ->orWhere('LOWER(p.pageContent) LIKE :key')
            ->orWhere('LOWER(trans.name) LIKE :key')
            ->orWhere('LOWER(trans.metaTitle) LIKE :key')
            ->orWhere('LOWER(trans.metaKeywords) LIKE :key')
            ->orWhere('LOWER(trans.metaDescription) LIKE :key')
            ->orWhere('LOWER(trans.pageTitle) LIKE :key')
            ->orWhere('LOWER(trans.breadcrumb) LIKE :key')
            ->orWhere('LOWER(trans.pageContent) LIKE :key')
            ->setParameter('key', '%' . strtolower($q) . '%');
        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }

    /**
     * Get Query for All Entities
     *
     * @return \Doctrine\ORM\Query
     */
    public function searchQuery($q)
    {

        $qb = $this->createQueryBuilder('p')->distinct()
            ->leftJoin('p.i18ns', 'trans')
            ->where('LOWER(p.name) LIKE :key')
            ->orWhere('LOWER(p.name) LIKE :key')
            ->orWhere('LOWER(p.metaTitle) LIKE :key')
            ->orWhere('LOWER(p.metaKeywords) LIKE :key')
            ->orWhere('LOWER(p.metaDescription) LIKE :key')
            ->orWhere('LOWER(p.pageTitle) LIKE :key')
            ->orWhere('LOWER(p.breadcrumb) LIKE :key')
            ->orWhere('LOWER(p.pageContent) LIKE :key')
            ->orWhere('LOWER(trans.name) LIKE :key')
            ->orWhere('LOWER(trans.metaTitle) LIKE :key')
            ->orWhere('LOWER(trans.metaKeywords) LIKE :key')
            ->orWhere('LOWER(trans.metaDescription) LIKE :key')
            ->orWhere('LOWER(trans.pageTitle) LIKE :key')
            ->orWhere('LOWER(trans.breadcrumb) LIKE :key')
            ->orderBy('p.rank', 'DESC')
            ->setParameter('key', '%' . strtolower($q) . '%');
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
    public function search($q)
    {
        return $this->searchQuery($q)->execute();
    }
}