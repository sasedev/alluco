<?php

namespace Alluco\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Sasedev\Commons\SharedBundle\Validator as ExtraAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 * @ORM\Table(name="a_contacts", indexes={@ORM\Index(name="fk_a_contacts_job", columns={"job_id"})})
 * @ORM\Entity(repositoryClass="Alluco\DataBundle\Repository\ContactRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Contact
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
     * @ORM\Column(name="firstname", type="text", nullable=false)
     * @Assert\Length(max="65", groups={"firstName"})
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="text", nullable=false)
     * @Assert\Length(max="65", groups={"lastName"})
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="text", nullable=false)
     * @Assert\Length(max="500", groups={"email"})
     * @Assert\Email(checkMX=true, checkHost=true, groups={"email"})
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="text", nullable=true)
     * @Assert\Length(max="25", groups={"phone"})
     * @ExtraAssert\Phone(groups={"phone"})
     */
    protected $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="text", nullable=true)
     * @Assert\Length(max="245", groups={"company"})
     */
    protected $company;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="text", nullable=true)
     * @Assert\Length(max="100", groups={"subject"})
     */
    protected $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="msg", type="text", nullable=true)
     * @Assert\Length(min="10", groups={"msg"})
     */
    protected $msg;

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
     * @var Jobs
     *
     * @ORM\ManyToOne(targetEntity="Job", inversedBy="contacts")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="job_id", referencedColumnName="id")
     * })
     */
    protected $job;

    /**
     * Constructor
     */
    public function __construct()
    {

        $this->setDtCrea(new \DateTime('now'));
    }

    /**
     * Get integer
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get string
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set $firstName
     *
     * @param string $firstName
     *
     * @return Contact $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get string
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set $lastName
     *
     * @param string $lastName
     *
     * @return Contact $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get string
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set $email
     *
     * @param string $email
     *
     * @return Contact $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get string
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set $phone
     *
     * @param string $phone
     *
     * @return Contact $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get string
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set $company
     *
     * @param string $company
     *
     * @return Contact $this
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get string
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set $subject
     *
     * @param string $subject
     *
     * @return Contact $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get string
     *
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * Set $msg
     *
     * @param string $msg
     *
     * @return Contact $this
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;

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
     * @return Contact $this
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
     * @return Contact $this
     */
    public function setDtUpdate(\DateTime $dtUpdate = null)
    {
        $this->dtUpdate = $dtUpdate;

        return $this;
    }

    /**
     * Get Jobs
     *
     * @return Jobs
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set $job
     *
     * @param Job $job
     *
     * @return Contact $this
     */
    public function setJob(Job $job = null)
    {
        $this->job = $job;

        return $this;
    }

}
