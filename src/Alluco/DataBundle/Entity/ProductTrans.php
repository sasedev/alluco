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
 * @ORM\Table(name="a_product_i18ns")
 * @ORM\Entity(repositoryClass="Alluco\DataBundle\Repository\ProductTransRepository")
 * @ORM\HasLifecycleCallbacks
 */
class ProductTrans
{

    /**
     * @var Lang
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="productI18ns")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lang_id", referencedColumnName="id")
     * })
     */
    protected $lang;

    /**
     * @var Product
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="i18ns")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    protected $product;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", nullable=false)
     * @Assert\Length(max="245", groups={"name"})
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="metatitle", type="text", nullable=true)
     */
    protected $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="metakeywords", type="text", nullable=true)
     */
    protected $metaKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="metadescription", type="text", nullable=true)
     */
    protected $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="pagetitle", type="text", nullable=true)
     */
    protected $pageTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="breadcrumb", type="text", nullable=true)
     */
    protected $breadcrumb;

    /**
     * @var string
     *
     * @ORM\Column(name="pagecontent", type="text", nullable=true)
     */
    protected $pageContent;

    /**
     * @var string
     *
     * @ORM\Column(name="thumb_alt", type="text", nullable=true)
     */
    protected $thumbAlt;

    /**
     * @var string
     *
     * @ORM\Column(name="thumb_title", type="text", nullable=true)
     */
    protected $thumbTitle;

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
     * @return ProductTrans $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return ProductTrans
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set metaKeywords
     *
     * @param string $metaKeywords
     * @return ProductTrans
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     * @return ProductTrans
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set pageTitle
     *
     * @param string $pageTitle
     * @return ProductTrans
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;

        return $this;
    }

    /**
     * Get pageTitle
     *
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * Set breadcrumb
     *
     * @param string $breadcrumb
     * @return ProductTrans
     */
    public function setBreadcrumb($breadcrumb)
    {
        $this->breadcrumb = $breadcrumb;

        return $this;
    }

    /**
     * Get breadcrumb
     *
     * @return string
     */
    public function getBreadcrumb()
    {
        return $this->breadcrumb;
    }

    /**
     * Set pageContent
     *
     * @param string $pageContent
     * @return ProductTrans
     */
    public function setPageContent($pageContent)
    {
        $this->pageContent = $pageContent;

        return $this;
    }

    /**
     * Get pageContent
     *
     * @return string
     */
    public function getPageContent()
    {
        return $this->pageContent;
    }

    /**
     * Set thumbAlt
     *
     * @param string $thumbAlt
     * @return ProductTrans
     */
    public function setThumbAlt($thumbAlt)
    {
        $this->thumbAlt = $thumbAlt;

        return $this;
    }

    /**
     * Get thumbAlt
     *
     * @return string
     */
    public function getThumbAlt()
    {
        return $this->thumbAlt;
    }

    /**
     * Set thumbTitle
     *
     * @param string $thumbTitle
     * @return ProductTrans
     */
    public function setThumbTitle($thumbTitle)
    {
        $this->thumbTitle = $thumbTitle;

        return $this;
    }

    /**
     * Get thumbTitle
     *
     * @return string
     */
    public function getThumbTitle()
    {
        return $this->thumbTitle;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return ProductTrans
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
     * @return ProductTrans
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
     * @return ProductTrans
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
     * Set product
     *
     * @param Product $product
     * @return ProductTrans
     */
    public function setProduct(Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

}
