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
 * @ORM\Table(name="a_sitenews")
 * @ORM\Entity(repositoryClass="Alluco\DataBundle\Repository\SitenewRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"pageUrl"}, errorPath="pageUrl", groups={"pageUrl"})
 */
class Sitenew
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
     * @ORM\Column(name="pageurl", type="text", nullable=false)
     * @Assert\Length(max="245", groups={"pageUrl"})
     * @Gedmo\Slug(fields={"pageTitle"}, updatable=false, unique=true, separator="_", style="camel")
     */
    protected $pageUrl;

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
     * @var Collection @ORM\OneToMany(targetEntity="SitenewTrans", mappedBy="sitenew", cascade={"persist", "remove"})
     */
    protected $i18ns;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setDtCrea(new \DateTime('now'));

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
     * Get $pageUrl
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
     * @return Sitenew $this
     */
    public function setPageUrl($pageUrl)
    {
        $this->pageUrl = $pageUrl;

        return $this;
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
     * @return Sitenew $this
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
     * @return Sitenew $this
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
     * @return Sitenew $this
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
     * @return Sitenew $this
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
     * @return Sitenew $this
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
     * @return Sitenew $this
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
     * @return Sitenew $this
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
     * @return Sitenew $this
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
     * @return Sitenew $this
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;

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
     * @return Sitenew $this
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
     * @return Sitenew $this
     */
    public function setDtUpdate(\DateTime $dtUpdate = null)
    {
        $this->dtUpdate = $dtUpdate;

        return $this;
    }

    /**
     * Add i18ns
     *
     * @param SitenewTrans $i18ns
     * @return Sitenew
     */
    public function addI18n(SitenewTrans $i18ns)
    {
        $this->i18ns[] = $i18ns;

        return $this;
    }

    /**
     * Remove i18ns
     *
     * @param SitenewTrans $i18ns
     * @return Sitenew
     */
    public function removeI18n(SitenewTrans $i18ns)
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
     * @return Sitenew $this
     */
    public function setI18ns(Collection $i18ns)
    {
        $this->i18ns = $i18ns;

        return $this;
    }

}
