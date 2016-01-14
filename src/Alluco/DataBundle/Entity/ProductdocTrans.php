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
 * @ORM\Table(name="a_productdoc_i18ns")
 * @ORM\Entity(repositoryClass="Alluco\DataBundle\Repository\ProductdocTransRepository")
 * @ORM\HasLifecycleCallbacks
 */
class ProductdocTrans
{

    /**
     * @var Lang
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="productdocI18ns")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
     * })
     */
    protected $lang;

    /**
     * @var Productdoc
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Productdoc", inversedBy="i18ns")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="productdoc_id", referencedColumnName="id")
     * })
     */
    protected $productdoc;

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
     * @return ProductdocTrans
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
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return ProductdocTrans
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
     * @return ProductdocTrans
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
     * @return ProductdocTrans
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
     * Set productdoc
     *
     * @param Productdoc $productdoc
     * @return ProductdocTrans
     */
    public function setProductdoc(Productdoc $productdoc = null)
    {
        $this->productdoc = $productdoc;

        return $this;
    }

    /**
     * Get productdoc
     *
     * @return Productdoc
     */
    public function getProductdoc()
    {
        return $this->productdoc;
    }
}
