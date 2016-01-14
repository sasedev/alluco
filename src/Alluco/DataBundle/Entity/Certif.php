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
 * @ORM\Table(name="a_certifs")
 * @ORM\Entity(repositoryClass="Alluco\DataBundle\Repository\CertifRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Certif
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
     * @ORM\Column(name="filename", type="text", nullable=false)
     */
    protected $filename;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     * @Assert\Choice(callback="choiceStatusCallback", groups={"status"})
     */
    protected $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="rank", type="integer", nullable=false)
     */
    protected $rank;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    protected $title;

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
     * @var Collection @ORM\OneToMany(targetEntity="CertifTrans", mappedBy="certif", cascade={"persist", "remove"})
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

        $this->setI18ns(new ArrayCollection());
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
     * Get $filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set $filename
     *
     * @param string $filename
     *
     * @return Certif $this
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

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
     * @return Certif $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get $rank
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
     * @return Certif $this
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get $title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set $title
     *
     * @param string $title
     *
     * @return Certif $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get $title
     *
     * @param string $locale
     *
     * @return string
     */
    public function getTitleTrans($locale = null)
    {
        $title = null;
        if (null == $locale || \trim($locale) == '') {
            $locale = \Locale::getDefault();
        }
        foreach ($this->getI18Ns()  as $i18n)
        {
            if($i18n->getLang()->getLocale() == $locale) {
                $title = $i18n->getTitle();
            }
        }
        if (null == $title) {
            $title = $this->getTitle();
        }
        return $title;
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
     * @return Certif $this
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
     * @return Certif $this
     */
    public function setDtUpdate(\DateTime $dtUpdate = null)
    {
        $this->dtUpdate = $dtUpdate;

        return $this;
    }



    /**
     * Add i18ns
     *
     * @param CertifTrans $i18ns
     * @return Certif
     */
    public function addI18n(CertifTrans $i18ns)
    {
        $this->i18ns[] = $i18ns;

        return $this;
    }

    /**
     * Remove i18ns
     *
     * @param CertifTrans $i18ns
     */
    public function removeI18n(CertifTrans $i18ns)
    {
        $this->i18ns->removeElement($i18ns);
    }

    /**
     * Get i18ns
     *
     * @return ArrayCollection
     */
    public function getI18ns()
    {
        return $this->i18ns;
    }

    /**
     * Set $i18ns
     *
     * @param Collection $i18ns
     *
     * @return Certif $this
     */
    public function setI18ns(Collection $i18ns)
    {
        $this->i18ns = $i18ns;

        return $this;
    }

    /**
     * Choice Form status
     *
     * @return multitype:string
     */
    public static function choiceStatus()
    {
        return array(self::ST_DISABLED => 'Certif.status.choice.' . self::ST_DISABLED,
            self::ST_ENABLED => 'Certif.status.choice.' . self::ST_ENABLED);
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

}
