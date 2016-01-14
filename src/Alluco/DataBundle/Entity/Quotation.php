<?php

namespace Alluco\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 * @ORM\Table(name="a_user_quotations")
 * @ORM\Entity(repositoryClass="Alluco\DataBundle\Repository\QuotationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Quotation
{

    /**
     *
     * @var string
     */
    const TYPE_F50AL = "F50AL";

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="quotations")
     * @ORM\JoinColumns({@ORM\JoinColumn(name="user_id", referencedColumnName="id")})
     */
    protected $user;

    /**
     * @var string
     *
     * @ORM\Column(name="quotation", type="text", nullable=false)
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(name="json_values", type="text", nullable=true)
     */
    protected $values;

    /**
     *
     * @var \DateTime @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $dtCrea;

    /**
     *
     * @var \DateTime @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    protected $dtUpdate;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="QuotationAnswer", mappedBy="quotation", cascade={"persist", "remove"})
     * @ORM\OrderBy({"dtCrea" = "ASC"})
     */
    protected $answers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setDtCrea(new \DateTime('now'));

        $this->setAnswers(new ArrayCollection());
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Quotation
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set values
     *
     * @param string $values
     * @return Quotation
     */
    public function setValues($values)
    {
        $this->values = $values;

        return $this;
    }

    /**
     * Get values
     *
     * @return string
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Quotation
     */
    public function setDtCrea($dtCrea)
    {
        $this->dtCrea = $dtCrea;

        return $this;
    }

    /**
     * Get dtCrea
     *
     * @return \DateTime
     */
    public function getDtCrea()
    {
        return $this->dtCrea;
    }

    /**
     * Set dtUpdate
     *
     * @param \DateTime $dtUpdate
     * @return Quotation
     */
    public function setDtUpdate($dtUpdate)
    {
        $this->dtUpdate = $dtUpdate;

        return $this;
    }

    /**
     * Get dtUpdate
     *
     * @return \DateTime
     */
    public function getDtUpdate()
    {
        return $this->dtUpdate;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return Quotation
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add answers
     *
     * @param QuotationAnswer $answers
     * @return Quotation
     */
    public function addAnswer(QuotationAnswer $answers)
    {
        $this->answers[] = $answers;

        return $this;
    }

    /**
     * Remove answers
     *
     * @param QuotationAnswer $answers
     * @return Quotation
     */
    public function removeAnswer(QuotationAnswer $answers)
    {
        $this->answers->removeElement($answers);

        return $this;
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Set answers
     *
     * @param Collection $answers
     * @return Quotation
     */
    public function setAnswers(Collection $answers)
    {
        $this->answers = $answers;

        return $this;
    }
}
