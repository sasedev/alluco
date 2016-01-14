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
 * @ORM\Table(name="a_products")
 * @ORM\Entity(repositoryClass="Alluco\DataBundle\Repository\ProductRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"pageUrl", "productParent"}, errorPath="pageUrl", groups={"pageUrl"})
 * @UniqueEntity(fields={"pageUrlFull"}, errorPath="pageUrl", groups={"pageUrlFull"})
 * @UniqueEntity(fields={"name"}, errorPath="name", groups={"name"})
 */
class Product
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
     * @ORM\Column(name="pageurl_full", type="text", nullable=false)
     * @Gedmo\Slug(handlers={
     *      @Gedmo\SlugHandler(class="Gedmo\Sluggable\Handler\TreeSlugHandler", options={
     *          @Gedmo\SlugHandlerOption(name="parentRelationField", value="productParent"),
     *          @Gedmo\SlugHandlerOption(name="separator", value="/")
     *      })
     *  }, separator="_", updatable=true, style="camel", fields={"name"})
     */
    protected $pageUrlFull;

    /**
     * @var string
     *
     * @ORM\Column(name="pageurl", type="text", nullable=false)
     * @Assert\Length(max="245", groups={"pageUrl"})
     * @Gedmo\Slug(fields={"name"}, updatable=false, unique=true, separator="_", style="camel")
     */
    protected $pageUrl;

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
     * @var string
     *
     * @ORM\Column(name="thumb", type="text", nullable=true)
     * @Assert\Image(maxSize="4096k", mimeTypes={"image/jpg", "image/jpeg", "image/pjpeg", "image/gif", "image/png"}, groups={"thumb"})
     */
    protected $thumb;

    /**
     * @var integer
     *
     * @ORM\Column(name="rank", type="integer", nullable=false)
     */
    protected $rank;

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
     * @var Product @ORM\ManyToOne(targetEntity="Product", inversedBy="childs")
	 * @ORM\JoinColumns({@ORM\JoinColumn(name="product_id", referencedColumnName="id")})
     */
    protected $productParent;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="Product", mappedBy="productParent",cascade={"persist"})
     * @ORM\OrderBy({"rank" = "DESC"})
     */
    protected $childs;

    /**
     *
     * @var Collection @ORM\ManyToMany(targetEntity="Product", inversedBy="revAssociates")
     * @ORM\JoinTable(
     *  name="a_product_associates",
     *  joinColumns={@ORM\JoinColumn(name="child", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="parent", referencedColumnName="id")}
     * )
     * @ORM\OrderBy({"rank" = "DESC"})
     */
    protected $associates;

    /**
     *
     * @var Collection @ORM\ManyToMany(targetEntity="Product", mappedBy="associates")
     * @ORM\JoinTable(
     *  name="a_product_associates",
     *  joinColumns={@ORM\JoinColumn(name="parent", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="child", referencedColumnName="id")}
     * )
     * @ORM\OrderBy({"rank" = "DESC"})
     */
    protected $revAssociates;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="Productdoc", mappedBy="product", cascade={"persist", "remove"})
     * @ORM\OrderBy({"rank" = "DESC", "filename" = "ASC"})
     */
    protected $docs;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="Productpic", mappedBy="product", cascade={"persist", "remove"})
     * @ORM\OrderBy({"rank" = "DESC", "filename" = "ASC"})
     */
    protected $pics;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="ProductTrans", mappedBy="product", cascade={"persist", "remove"})
     */
    protected $i18ns;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setRank(100);

        $this->setDtCrea(new \DateTime('now'));

        $this->setDocs(new ArrayCollection());

        $this->setPics(new ArrayCollection());

        $this->setChilds(new ArrayCollection());

        $this->setAssociates(new ArrayCollection());

        $this->setRevAssociates(new ArrayCollection());

        $this->setI18ns(new ArrayCollection());
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
     * Get $pageUrlFull
     *
     * @return string
     */
    public function getPageUrlFull()
    {
        return $this->pageUrlFull;
    }

    /**
     * Set $pageUrlFull
     *
     * @param string $pageUrlFull
     *
     * @return Product $this
     */
    public function setPageUrlFull($pageUrlFull)
    {
        $this->pageUrlFull = $pageUrlFull;

        return $this;
    }

    /**
     * Get string
     *
     * @return string
     */
    public function getPageUrl()
    {
        return $this->pageUrl;
    }

    /**
     * Set $pageUrl
     *
     * @param string $pageUrl
     *
     * @return Product $this
     */
    public function setPageUrl($pageUrl)
    {
        $this->pageUrl = $pageUrl;

        return $this;
    }

    /**
     * Get string
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
     * @return Product $this
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
     * Get $metaTitle
     *
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set $metaTitle
     *
     * @param string $metaTitle
     *
     * @return Product $this
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get $metaTitle
     *
     * @param string $locale
     *
     * @return string
     */
    public function getMetaTitleTrans($locale = null)
    {
        $metaTitle = null;
        if (null == $locale || \trim($locale) == '') {
            $locale = \Locale::getDefault();
        }
        foreach ($this->getI18Ns()  as $i18n)
        {
            if($i18n->getLang()->getLocale() == $locale) {
                $metaTitle = $i18n->getMetaTitle();
            }
        }
        if (null == $metaTitle) {
            $metaTitle = $this->getMetaTitle();
        }
        return $metaTitle;
    }

    /**
     * Get $metaKeywords
     *
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * Set $metaKeywords
     *
     * @param string $metaKeywords
     *
     * @return Product $this
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get $metaKeywords
     *
     * @param string $locale
     *
     * @return string
     */
    public function getMetaKeywordsTrans($locale = null)
    {
        $metaKeywords = null;
        if (null == $locale || \trim($locale) == '') {
            $locale = \Locale::getDefault();
        }
        foreach ($this->getI18Ns()  as $i18n)
        {
            if($i18n->getLang()->getLocale() == $locale) {
                $metaKeywords = $i18n->getMetaKeywords();
            }
        }
        if (null == $metaKeywords) {
            $metaKeywords = $this->getMetaKeywords();
        }
        return $metaKeywords;
    }

    /**
     * Get $metaDescription
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set $metaDescription
     *
     * @param string $metaDescription
     *
     * @return Product $this
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get $metaDescription
     *
     * @param string $locale
     *
     * @return string
     */
    public function getMetaDescriptionTrans($locale = null)
    {
        $metaDescription = null;
        if (null == $locale || \trim($locale) == '') {
            $locale = \Locale::getDefault();
        }
        foreach ($this->getI18Ns()  as $i18n)
        {
            if($i18n->getLang()->getLocale() == $locale) {
                $metaDescription = $i18n->getMetaDescription();
            }
        }
        if (null == $metaDescription) {
            $metaDescription = $this->getMetaKeywords();
        }
        return $metaDescription;
    }

    /**
     * Get $pageTitle
     *
     * @return string
     */
    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * Set $pageTitle
     *
     * @param string $pageTitle
     *
     * @return Product $this
     */
    public function setPageTitle($pageTitle)
    {
        $this->pageTitle = $pageTitle;

        return $this;
    }

    /**
     * Get $pageTitle
     *
     * @param string $locale
     *
     * @return string
     */
    public function getPageTitleTrans($locale = null)
    {
        $pageTitle = null;
        if (null == $locale || \trim($locale) == '') {
            $locale = \Locale::getDefault();
        }
        foreach ($this->getI18Ns()  as $i18n)
        {
            if($i18n->getLang()->getLocale() == $locale) {
                $pageTitle = $i18n->getPageTitle();
            }
        }
        if (null == $pageTitle) {
            $pageTitle = $this->getPageTitle();
        }
        return $pageTitle;
    }

    /**
     * Get $breadcrumb
     *
     * @return string
     */
    public function getBreadcrumb()
    {
        return $this->breadcrumb;
    }

    /**
     * Set $breadcrumb
     *
     * @param string $breadcrumb
     *
     * @return Product $this
     */
    public function setBreadcrumb($breadcrumb)
    {
        $this->breadcrumb = $breadcrumb;

        return $this;
    }

    /**
     * Get $breadcrumb
     *
     * @param string $locale
     *
     * @return string
     */
    public function getBreadcrumbTrans($locale = null)
    {
        $breadcrumb = null;
        if (null == $locale || \trim($locale) == '') {
            $locale = \Locale::getDefault();
        }
        foreach ($this->getI18Ns()  as $i18n)
        {
            if($i18n->getLang()->getLocale() == $locale) {
                $breadcrumb = $i18n->getBreadcrumb();
            }
        }
        if (null == $breadcrumb) {
            $breadcrumb == $this->getBreadcrumb();
        }
        return $breadcrumb;
    }

    /**
     * Get $pageContent
     *
     * @return string
     */
    public function getPageContent()
    {
        return $this->pageContent;
    }

    /**
     * Set $pageContent
     *
     * @param string $pageContent
     *
     * @return Product $this
     */
    public function setPageContent($pageContent)
    {
        $this->pageContent = $pageContent;

        return $this;
    }

    /**
     * Get $pageContent
     *
     * @param string $locale
     *
     * @return string
     */
    public function getPageContentTrans($locale = null)
    {
        $pageContent = null;
        if (null == $locale || \trim($locale) == '') {
            $locale = \Locale::getDefault();
        }
        foreach ($this->getI18Ns()  as $i18n)
        {
            if($i18n->getLang()->getLocale() == $locale) {
                $pageContent = $i18n->getPageContent();
            }
        }
        if (null == $pageContent) {
            $pageContent = $this->getPageContent();
        }
        return $pageContent;
    }

    /**
     * Get string
     *
     * @return string
     */
    public function getThumbAlt()
    {
        return $this->thumbAlt;
    }

    /**
     * Set $thumbAlt
     *
     * @param string $thumbAlt
     *
     * @return Product $this
     */
    public function setThumbAlt($thumbAlt)
    {
        $this->thumbAlt = $thumbAlt;

        return $this;
    }

    /**
     * Get $thumbAlt
     *
     * @param string $locale
     *
     * @return string
     */
    public function getThumbAltTrans($locale = null)
    {
        $thumbAlt = null;
        if (null == $locale || \trim($locale) == '') {
            $locale = \Locale::getDefault();
        }
        foreach ($this->getI18Ns()  as $i18n)
        {
            if($i18n->getLang()->getLocale() == $locale) {
                $thumbAlt = $i18n->getThumbAlt();
            }
        }
        if (null == $thumbAlt) {
            $thumbAlt = $this->getThumbAlt();
        }
        return $thumbAlt;
    }

    /**
     * Get string
     *
     * @return string
     */
    public function getThumbTitle()
    {
        return $this->thumbTitle;
    }

    /**
     * Set $thumbTitle
     *
     * @param string $thumbTitle
     *
     * @return Product $this
     */
    public function setThumbTitle($thumbTitle)
    {
        $this->thumbTitle = $thumbTitle;

        return $this;
    }

    /**
     * Get $thumbTitle
     *
     * @param string $locale
     *
     * @return string
     */
    public function getThumbTitleTrans($locale = null)
    {
        $thumbTitle = null;
        if (null == $locale || \trim($locale) == '') {
            $locale = \Locale::getDefault();
        }
        foreach ($this->getI18Ns()  as $i18n)
        {
            if($i18n->getLang()->getLocale() == $locale) {
                $thumbTitle = $i18n->getThumbTitle();
            }
        }
        if (null == $thumbTitle) {
            $thumbTitle = $this->getThumbTitle();
        }
        return $thumbTitle;
    }

    /**
     * Get string
     *
     * @return string
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * Set $thumb
     *
     * @param string $thumb
     *
     * @return Product $this
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;

        return $this;
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
     * @return Product $this
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

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
     * @return Product $this
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
     * @return Product $this
     */
    public function setDtUpdate(\DateTime $dtUpdate = null)
    {
        $this->dtUpdate = $dtUpdate;

        return $this;
    }

    /**
     * Get $productParent
     *
     * @return Product
     */
    public function getProductParent()
    {
        return $this->productParent;
    }

    /**
     * Set $productParent
     *
     * @param Product $productParent
     *
     * @return Product $this
     */
    public function setProductParent(Product $productParent = null)
    {
        $this->productParent = $productParent;

        if (null == $productParent) {
            $this->setPageUrlFull($this->getPageUrl());
        }

        return $this;
    }

    /**
     * Add $doc
     *
     * @param Productdoc $doc
     *
     * @return Product $this
     */
    public function addDoc(Productdoc $doc)
    {
        $this->docs[] = $doc;

        return $this;
    }

    /**
     * Remove $product
     *
     * @param Productdoc $doc
     *
     * @return Product $this
     */
    public function removeDoc(Productdoc $doc)
    {
        $this->docs->removeElement($doc);

        return $this;
    }

    /**
     * Get $docs
     *
     * @return ArrayCollection
     */
    public function getDocs()
    {
        return $this->docs;
    }

    /**
     * Set $docs
     *
     * @param Collection $docs
     *
     * @return Product $this
     */
    public function setDocs(Collection $docs)
    {
        $this->docs = $docs;

        return $this;
    }

    /**
     * Add $pic
     *
     * @param Productpic $pic
     *
     * @return Product $this
     */
    public function addPic(Productpic $pic)
    {
        $this->pics[] = $pic;

        return $this;
    }

    /**
     * Remove $product
     *
     * @param Productpic $pic
     *
     * @return Product $this
     */
    public function removePic(Productpic $pic)
    {
        $this->pics->removeElement($pic);

        return $this;
    }

    /**
     * Get $pics
     *
     * @return ArrayCollection
     */
    public function getPics()
    {
        return $this->pics;
    }

    /**
     * Set $pics
     *
     * @param Collection $pics
     *
     * @return Product $this
     */
    public function setPics(Collection $pics)
    {
        $this->pics = $pics;

        return $this;
    }

    /**
     * Add childs
     *
     * @param Product $childs
     * @return Product
     */
    public function addChild(Product $childs)
    {
        $this->childs[] = $childs;

        return $this;
    }

    /**
     * Remove childs
     *
     * @param Product $childs
     */
    public function removeChild(Product $childs)
    {
        $this->childs->removeElement($childs);

        return $this;
    }

    /**
     * Get childs
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
     * @param Collection $childs
     *
     * @return Product $this
     */
    public function setChilds(Collection $childs)
    {
        $this->childs = $childs;

        return $this;
    }

    /**
     * Add associates
     *
     * @param Product $associates
     * @return Product
     */
    public function addAssociate(Product $associates)
    {
        $this->associates[] = $associates;

        return $this;
    }

    /**
     * Remove associates
     *
     * @param Product $associates
     *
     * @return Product $this
     */
    public function removeAssociate(Product $associates)
    {
        $this->associates->removeElement($associates);

        return $this;
    }

    /**
     * Get associates
     *
     * @return ArrayCollection
     */
    public function getAssociates()
    {
        return $this->associates;
    }

    /**
     * Set $associates
     *
     * @param Collection $associates
     *
     * @return Product $this
     */
    public function setAssociates(Collection $associates)
    {
        $this->associates = $associates;

        return $this;
    }

    /**
     * Add revAssociates
     *
     * @param Product $revAssociates
     * @return Product
     */
    public function addRevAssociate(Product $revAssociates)
    {
        $this->revAssociates[] = $revAssociates;

        return $this;
    }

    /**
     * Remove revAssociates
     *
     * @param Product $revAssociates
     *
     * @return Product $this
     */
    public function removeRevAssociate(Product $revAssociates)
    {
        $this->revAssociates->removeElement($revAssociates);

        return $this;
    }

    /**
     * Get revAssociates
     *
     * @return ArrayCollection
     */
    public function getRevAssociates()
    {
        return $this->revAssociates;
    }

    /**
     * Set $revAssociates
     *
     * @param Collection $revAssociates
     *
     * @return Product $this
     */
    public function setRevAssociates(Collection $revAssociates)
    {
        $this->revAssociates = $revAssociates;

        return $this;
    }

    /**
     * Add i18ns
     *
     * @param ProductTrans $i18ns
     * @return Product
     */
    public function addI18n(ProductTrans $i18ns)
    {
        $this->i18ns[] = $i18ns;

        return $this;
    }

    /**
     * Remove i18ns
     *
     * @param ProductTrans $i18ns
     *
     * @return Product $this
     */
    public function removeI18n(ProductTrans $i18ns)
    {
        $this->i18ns->removeElement($i18ns);

        return $this;
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
     * @return Product $this
     */
    public function setI18ns(Collection $i18ns)
    {
        $this->i18ns = $i18ns;

        return $this;
    }

}
