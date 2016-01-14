<?php

namespace Alluco\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 * @ORM\Table(name="a_jobs")
 * @ORM\Entity(repositoryClass="Alluco\DataBundle\Repository\JobRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Job
{

    /**
     *
     * @var integer
     */
    const ST_DISABLED = 2;

    /**
     *
     * @var integer
     */
    const ST_ENABLED = 1;

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
     * @ORM\Column(name="name", type="text", nullable=false)
     */
    protected $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="rank", type="integer", nullable=false)
     */
    protected $rank;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     * @Assert\Choice(callback="choiceStatusCallback", groups={"status"})
     */
    protected $status;

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
     * @var Collection @ORM\OneToMany(targetEntity="User", mappedBy="job", cascade={"persist", "remove"})
     * @ORM\OrderBy({"username" = "ASC"})
     */
    protected $users;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="Contact", mappedBy="job", cascade={"persist", "remove"})
     * @ORM\OrderBy({"dtCrea" = "ASC"})
     */
    protected $contacts;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="JobTrans", mappedBy="job", cascade={"persist", "remove"})
     */
    protected $i18ns;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setStatus(self::ST_DISABLED);

        $this->setRank(100);

        $this->setDtCrea(new \DateTime('now'));

        $this->setUsers(new ArrayCollection());

        $this->setContacts(new ArrayCollection());
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
     * @return Job $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get $name
     *
     * @param string $locale
     *
     * @return string
     */
    public function getNameTrans($locale = null)
    {
        $name = null;
        if (null == $locale || \trim($locale) == '') {
            $locale = \Locale::getDefault();
        }
        foreach ($this->getI18Ns()  as $i18n)
        {
            if($i18n->getLang()->getLocale() == $locale) {
                $name = $i18n->getName();
            }
        }
        if (null == $name) {
            $name = $this->getName();
        }
        return $name;
    }

    /**
     * Get integer
     *
     * @return integer
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set $rank
     *
     * @param integer $rank
     *
     * @return Job $this
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get $status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set $status
     *
     * @param integer $status
     *
     * @return Job $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

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
     * @return Job $this
     */
    public function setDtCrea(\DateTime $dtCrea = null)
    {
        $this->dtCrea = $dtCrea;

        return $this;
    }

    /**
     * Get \$dtUpdate
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
     * @return Job $this
     */
    public function setDtUpdate(\DateTime $dtUpdate = null)
    {
        $this->dtUpdate = $dtUpdate;

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
     * @return Job $this
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
     * @return Job $this
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
     * @return Job $this
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);

        return $this;
    }

    /**
     * Get $contacts
     *
     * @return ArrayCollection
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Set $contacts
     *
     * @param Collection $contacts
     *
     * @return Job $this
     */
    public function setContacts(Collection $contacts)
    {
        $this->contacts = $contacts;

        return $this;
    }

    /**
     * Add $contact
     *
     * @param Contact $contact
     *
     * @return Job $this
     */
    public function addContact(Contact $contact)
    {
        $this->contacts[] = $contact;

        return $this;
    }

    /**
     * Remove $contact
     *
     * @param Contact $contact
     *
     * @return Job $this
     */
    public function removeContact(Contact $contact)
    {
        $this->contacts->removeElement($contact);

        return $this;
    }

    /**
     * Choice Form status
     *
     * @return multitype:string
     */
    public static function choiceStatus()
    {
        return array(self::ST_DISABLED => 'Job.status.choice.' . self::ST_DISABLED,
            self::ST_ENABLED => 'Job.status.choice.' . self::ST_ENABLED);
    }

    /**
     * Choice Validator status
     *
     * @return multitype:integer
     */
    public static function choiceStatusCallback()
    {
        return array(self::ST_DISABLED, self::ST_ENABLED);
    }



    /**
     * Add i18ns
     *
     * @param JobTrans $i18ns
     * @return Job
     */
    public function addI18n(JobTrans $i18ns)
    {
        $this->i18ns[] = $i18ns;

        return $this;
    }

    /**
     * Remove i18ns
     *
     * @param JobTrans $i18ns
     */
    public function removeI18n(JobTrans $i18ns)
    {
        $this->i18ns->removeElement($i18ns);
    }

    /**
     * Get i18ns
     *
     * @return Collection
     */
    public function getI18ns()
    {
        return $this->i18ns;
    }
}
