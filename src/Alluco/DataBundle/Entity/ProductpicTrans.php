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
 * @ORM\Table(name="a_productpic_i18ns")
 * @ORM\Entity(repositoryClass="Alluco\DataBundle\Repository\ProductpicTransRepository")
 * @ORM\HasLifecycleCallbacks
 */
class ProductpicTrans
{

    /**
     * @var Lang
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="productpicI18ns")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
     * })
     */
    protected $lang;

    /**
     * @var Productpic
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Productpic", inversedBy="i18ns")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="productpic_id", referencedColumnName="id")
     * })
     */
    protected $productpic;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="text", nullable=true)
     */
    protected $alt;

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
     * Constructor
     */
    public function __construct()
    {
        $this->setDtCrea(new \DateTime('now'));
    }


    /**
     * Set title
     *
     * @param string $title
     * @return ProductpicTrans
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set alt
     *
     * @param string $alt
     * @return ProductpicTrans
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return ProductpicTrans
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
     * @return ProductpicTrans
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
     * Set lang
     *
     * @param Lang $lang
     * @return ProductpicTrans
     */
    public function setLang(Lang $lang = null)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return Lang
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set productpic
     *
     * @param Productpic $productpic
     * @return ProductpicTrans
     */
    public function setProductpic(Productpic $productpic = null)
    {
        $this->productpic = $productpic;

        return $this;
    }

    /**
     * Get productpic
     *
     * @return Productpic
     */
    public function getProductpic()
    {
        return $this->productpic;
    }
}
