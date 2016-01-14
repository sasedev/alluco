<?php

namespace Alluco\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 * @ORM\Table(name="a_roles")
 * @ORM\Entity(repositoryClass="Alluco\DataBundle\Repository\RoleRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"name"}, errorPath="name", groups={"name"})
 */
class Role implements RoleInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     * @Assert\Length(max=100, groups={"name"})
     * @Assert\Regex(pattern="/^ROLE\_[A-Z](([A-Z0-9\_]+[A-Z0-9])|[A-Z0-9])$/", groups={"name"})
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $dtCrea;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    protected $dtUpdate;

    /**
     *
     * @var Collection @ORM\ManyToMany(targetEntity="Role", inversedBy="childs")
     * @ORM\JoinTable(
     *  name="a_role_parents",
     *  joinColumns={@ORM\JoinColumn(name="child", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="parent", referencedColumnName="id")}
     * )
     * @ORM\OrderBy({"name" = "ASC"})
     */
    protected $parents;

    /**
     *
     * @var Collection @ORM\ManyToMany(targetEntity="Role", mappedBy="parents")
     * @ORM\JoinTable(
     *  name="a_role_parents",
     *  joinColumns={@ORM\JoinColumn(name="parent", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="child", referencedColumnName="id")}
     * )
     * @ORM\OrderBy({"name" = "ASC"})
     */
    protected $childs;

    /**
     *
     * @var Collection @ORM\ManyToMany(targetEntity="User", mappedBy="userRoles")
     * @ORM\JoinTable(
     *  name="a_users_roles",
     *  joinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    protected $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setDtCrea(new \DateTime('now'));

        $this->setParents(new ArrayCollection());

        $this->setChilds(new ArrayCollection());

        $this->setUsers(new ArrayCollection());
    }

    /**
     * Get $id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get $name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set $name
     *
     * @param string $name
     *
     * @return Role $this
     */
    public function setName($name)
    {
        $this->name = strtoupper(trim($name));

        return $this;
    }

    /**
     * Get $description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set $description
     *
     * @param string $description
     *
     * @return Role $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get $dtCrea
     *
     * @return \DateTime
     */
    public function getDtCrea()
    {
        return $this->dtCrea;
    }

    /**
     * Set $dtCrea
     *
     * @param \DateTime $dtCrea
     *
     * @return Role $this
     */
    public function setDtCrea(\DateTime $dtCrea = null)
    {
        $this->dtCrea = $dtCrea;

        return $this;
    }

    /**
     * Get $dtUpdate
     *
     * @return \DateTime
     */
    public function getDtUpdate()
    {
        return $this->dtUpdate;
    }

    /**
     * Set $dtUpdate
     *
     * @param \DateTime $dtUpdate
     *
     * @return Role $this
     */
    public function setDtUpdate(\DateTime $dtUpdate = null)
    {
        $this->dtUpdate = $dtUpdate;

        return $this;
    }

    /**
     * Get $parents
     *
     * @return ArrayCollection
     */
    public function getParents()
    {
        return $this->parents;
    }

    /**
     * Set $parents
     *
     * @param Collection $roles
     *
     * @return Role $this
     */
    public function setParents(Collection $parents)
    {
        $this->parents = $parents;

        return $this;
    }

    /**
     * Add $role
     *
     * @param Role $role
     *
     * @return Role $this
     */
    public function addParent(Role $role)
    {
        $this->parents[] = $role;

        return $this;
    }

    /**
     * Remove $role
     *
     * @param Role $role
     *
     * @return Role $this
     */
    public function removeParent(Role $role)
    {
        $this->parents->removeElement($role);

        return $this;
    }

    /**
     * Get $childs
     *
     * @return ArrayCollection
     */
    public function getChilds()
    {
        return $this->childs;
    }

    /**
     * Set $childs
     *
     * @param Collection $roles
     *
     * @return Role
     */
    public function setChilds(Collection $childs)
    {
        $this->childs = $childs;

        return $this;
    }

    /**
     * Add $role
     *
     * @param Role $role
     *
     * @return Role $this
     */
    public function addChild(Role $role)
    {
        $this->childs[] = $role;

        return $this;
    }

    /**
     * Remove $role
     *
     * @param Role $role
     *
     * @return Role $this
     */
    public function removeChild(Role $role)
    {
        $this->childs->removeElement($role);

        return $this;
    }

    /**
     * Get $users
     *
     * @return ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set $users
     *
     * @param Collection $users
     *
     * @return Role $this
     */
    public function setUsers(Collection $users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Add $user
     *
     * @param User $user
     *
     * @return Role $this
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove $user
     *
     * @param User $user
     *
     * @return Role $this
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);

        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function isCanDelete()
    {
        if (count($this->getUsers()) != 0) {
            return false;
        }
        return true;
    }

    /**
     * (non-PHPdoc) @see \Symfony\Component\Security\Core\Role\RoleInterface::getRole()
     *
     * @return string
     */
    public function getRole()
    {
        return $this->getName();
    }

    /**
     * string representation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getName();
    }

}
