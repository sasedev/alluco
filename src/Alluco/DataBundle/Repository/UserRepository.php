<?php

namespace Alluco\DataBundle\Repository;

use Alluco\DataBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class UserRepository extends EntityRepository implements UserProviderInterface
{

    /**
     * Used for Authentification Security
     * (non-PHPdoc) @see \Symfony\Component\Security\Core\User\UserProviderInterface::loadUserByUsername()
     *
     * @param string $username
     *
     * @throws UsernameNotFoundException
     *
     * @return Ambigous <\Doctrine\ORM\mixed, mixed, \Doctrine\ORM\Internal\Hydration\mixed,
     *         \Doctrine\DBAL\Driver\Statement, \Doctrine\Common\Cache\mixed>
     */
    public function loadUserByUsername($username)
    {
    	return $this->getEntityManager()
    	->createQuery('SELECT u FROM
         AllucoDataBundle:User u
         WHERE (u.username = :username
         OR u.email = :username) AND u.lockout = :lockout')
    	         ->setParameters(array(
    	         	'username' => $username,
    	         	'lockout' => User::LOCKOUT_UNLOCKED
    	         ))
    	         ->getOneOrNullResult();
    }

    /**
     * Used for Authentification Security
     * (non-PHPdoc) @see \Symfony\Component\Security\Core\User\UserProviderInterface::refreshUser()
     *
     * @param UserInterface $user
     *
     * @return User
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * Check if is a sublass of the Entity
     * (non-PHPdoc) @see \Symfony\Component\Security\Core\User\UserProviderInterface::supportsClass()
     *
     * @param string $class
     *
     * @return boolean
     */
    public function supportsClass($class)
    {
        return $this->getEntityName() === $class || is_subclass_of($class, $this->getEntityName());
    }

    /**
     * Count All
     *
     * @return Ambigous <\Doctrine\ORM\mixed, mixed, multitype:, \Doctrine\DBAL\Driver\Statement,
     *         \Doctrine\Common\Cache\mixed>
     */
    public function count()
    {
        $qb = $this->createQueryBuilder('u')->select('count(u)');
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
        $qb = $this->createQueryBuilder('u')
            ->orderBy('u.username', 'ASC');
        $query = $qb->getQuery();

        return $query;
    }

    /**
     * Get All Entities
     *
     * @return Ambigous <\Doctrine\ORM\mixed, \Doctrine\ORM\Internal\Hydration\mixed, \Doctrine\DBAL\Driver\Statement,
     *         \Doctrine\Common\Cache\mixed>
     */
    public function getAll()
    {
        return $this->getAllQuery()->execute();
    }

    /**
     * Count All
     *
     * @return Ambigous <\Doctrine\ORM\mixed, mixed, multitype:, \Doctrine\DBAL\Driver\Statement,
     *         \Doctrine\Common\Cache\mixed>
     */
    public function countSearch($q)
    {
        $qb = $this->createQueryBuilder('u')
            ->select('count(u)')
            ->distinct()
            ->where('LOWER(u.username) LIKE :key')
            ->orWhere('LOWER(u.email) LIKE :key')
            ->orWhere('LOWER(u.firstName) LIKE :key')
            ->orWhere('LOWER(u.lastName) LIKE :key')
            ->orWhere('LOWER(u.streetNum) LIKE :key')
            ->orWhere('LOWER(u.address) LIKE :key')
            ->orWhere('LOWER(u.address2) LIKE :key')
            ->orWhere('LOWER(u.town) LIKE :key')
            ->orWhere('LOWER(u.zipCode) LIKE :key')
            ->orWhere('LOWER(u.mobile) LIKE :key')
            ->orWhere('LOWER(u.phone) LIKE :key')
            ->setParameter('key', '%' . strtolower($q) . '%');
        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }

    /**
     * Get Query for All Entities
     *
     * @return \Doctrine\ORM\Query
     */
    public function getAllSearchQuery($q)
    {
        $qb = $this->createQueryBuilder('u')
            ->distinct()
            ->where('LOWER(u.username) LIKE :key')
            ->orWhere('LOWER(u.email) LIKE :key')
            ->orWhere('LOWER(u.firstName) LIKE :key')
            ->orWhere('LOWER(u.lastName) LIKE :key')
            ->orWhere('LOWER(u.streetNum) LIKE :key')
            ->orWhere('LOWER(u.address) LIKE :key')
            ->orWhere('LOWER(u.address2) LIKE :key')
            ->orWhere('LOWER(u.town) LIKE :key')
            ->orWhere('LOWER(u.zipCode) LIKE :key')
            ->orWhere('LOWER(u.mobile) LIKE :key')
            ->orWhere('LOWER(u.phone) LIKE :key')
            ->orderBy('u.username', 'ASC')
            ->setParameter('key', '%' . strtolower($q) . '%');
        $query = $qb->getQuery();

        return $query;
    }

    /**
     * Get All Entities
     *
     * @return Ambigous <\Doctrine\ORM\mixed, \Doctrine\ORM\Internal\Hydration\mixed, \Doctrine\DBAL\Driver\Statement,
     *         \Doctrine\Common\Cache\mixed>
     */
    public function getAllSearch($q)
    {
        return $this->getAllSearchQuery($q)->execute();
    }

    /**
     * Count All that are Active 1 minute ago
     *
     * @return Ambigous <\Doctrine\ORM\mixed, mixed, multitype:, \Doctrine\DBAL\Driver\Statement,
     *         \Doctrine\Common\Cache\mixed>
     */
    public function countAllActiveNow($strtotime = null)
    {
        if (null == $strtotime || trim($strtotime) == '') {
            $strtotime = '1 minutes ago';
        }

        $delay = new \DateTime();
        $delay->setTimestamp(strtotime($strtotime));

        $qb = $this->createQueryBuilder('u')
            ->select('count(u)')
            ->where('u.lastActivity > :delay')
            ->orderBy('u.lastActivity', 'ASC')
            ->setParameter('delay', $delay);
        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }

    /**
     * Get Query for All Entities that are Active 1 minute ago
     *
     * @return \Doctrine\ORM\Query
     */
    public function getAllActiveNowQuery($strtotime = null)
    {
        if (null == $strtotime || trim($strtotime) == '') {
            $strtotime = '1 minutes ago';
        }

        $delay = new \DateTime();
        $delay->setTimestamp(strtotime($strtotime));

        $qb = $this->createQueryBuilder('u')
            ->where('u.lastActivity > :delay')
            ->setParameter('delay', $delay)
            ->orderBy('u.lastActivity', 'DESC');
        $query = $qb->getQuery();

        return $query;
    }

    /**
     * Get All Entities that are Active 1 minute ago
     *
     * @return Ambigous <\Doctrine\ORM\mixed, \Doctrine\ORM\Internal\Hydration\mixed, \Doctrine\DBAL\Driver\Statement,
     *         \Doctrine\Common\Cache\mixed>
     */
    public function getAllActiveNow($strtotime = null)
    {
        return $this->getAllActiveNowQuery($strtotime)->execute();
    }

    /**
     * Count All Unlocked
     *
     * @return Ambigous <\Doctrine\ORM\mixed, mixed, multitype:, \Doctrine\DBAL\Driver\Statement,
     *         \Doctrine\Common\Cache\mixed>
     */
    public function countAllUnlocked()
    {
        $qb = $this->createQueryBuilder('u')
            ->select('count(u)')
            ->where('u.lockout = :lockout')
            ->setParameter('lockout', User::LOCKOUT_UNLOCKED);
        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }

    /**
     * Get Query for All Entities where lockout is unlocked
     *
     * @return \Doctrine\ORM\Query
     */
    public function getAllUnlockedQuery()
    {
        $qb = $this->createQueryBuilder('u')
            ->where('u.lockout = :lockout')
            ->orderBy('u.username', 'ASC')
            ->setParameter('lockout', User::LOCKOUT_UNLOCKED);
        $query = $qb->getQuery();

        return $query;
    }

    /**
     * Get All Entities where lockout is unlocked
     *
     * @return Ambigous <\Doctrine\ORM\mixed, \Doctrine\ORM\Internal\Hydration\mixed, \Doctrine\DBAL\Driver\Statement,
     *         \Doctrine\Common\Cache\mixed>
     */
    public function getAllUnlocked()
    {
        return $this->getAllUnlockedQuery()->execute();
    }
}
