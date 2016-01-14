<?php

namespace Alluco\DataBundle\Listener;

use Sasedev\Commons\SharedBundle\Security\RoleHierarchy as BaseRoleHierarchy;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class RoleHierarchy extends BaseRoleHierarchy
{

    /*
     * (non-PHPdoc) @see \SASEdev\Commons\SharedBundle\Role\RoleHierarchy::buildRolesTree()
     */
    public function buildRolesTree()
    {
        $hierarchy = array();
        $roles = $this->getEntitymanager()
            ->getRepository('AllucoDataBundle:Role')
            ->getAll();

        foreach ($roles as $role) {
            if (count($role->getParents()) > 0) {
                $roleParents = array();

                foreach ($role->getParents() as $parent) {
                    $roleParents[] = $parent->getRole();
                }

                $hierarchy[$role->getRole()] = $roleParents;
            }
        }

        return $hierarchy;
    }
}
