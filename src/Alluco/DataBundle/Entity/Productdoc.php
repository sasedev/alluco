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
 * @ORM\Table(name="a_productdocs")
 * @ORM\Entity(repositoryClass="Alluco\DataBundle\Repository\ProductdocRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Productdoc
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
     * @var integer
     *
     * @ORM\Column(name="rank", type="integer", nullable=false)
     */
    protected $rank;

    /**
     *
     * @var string @ORM\Column(name="filename", type="text", nullable=false)
     * @Assert\File(maxSize="4096k", groups={"filename"})
     */
    protected $filename;

    /**
     *
     * @var integer @ORM\Column(name="filesize", type="integer", nullable=false)
     */
    protected $size;

    /**
     *
     * @var string @ORM\Column(name="filemimetype", type="text", nullable=false)
     */
    protected $mimeType;

    /**
     *
     * @var string @ORM\Column(name="filemd5", type="text", nullable=false)
     */
    protected $md5;

    /**
     *
     * @var string @ORM\Column(name="fileoname", type="text", nullable=false)
     */
    protected $originalName;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=true)
     */
    protected $title;

    /**
     *
     * @var integer @ORM\Column(name="filedls", type="integer", nullable=false)
     */
    protected $nbrDownloads;

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
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="docs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    protected $product;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="ProductdocTrans", mappedBy="productdoc", cascade={"persist", "remove"})
     */
    protected $i18ns;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setDtCrea(new \DateTime('now'));

        $this->setRank(100);

        $this->setNbrDownloads(0);

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
     * @return Productdoc $this
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get string
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
     * @return Productdoc $this
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get integer
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set $size
     *
     * @param integer $size
     *
     * @return Productdoc $this
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get string
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set $mimeType
     *
     * @param string $mimeType
     *
     * @return Productdoc $this
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get string
     *
     * @return string
     */
    public function getMd5()
    {
        return $this->md5;
    }

    /**
     * Set $md5
     *
     * @param string $md5
     *
     * @return Productdoc $this
     */
    public function setMd5($md5)
    {
        $this->md5 = $md5;

        return $this;
    }

    /**
     * Get string
     *
     * @return string
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * Set $originalName
     *
     * @param string $originalName
     *
     * @return Productdoc $this
     */
    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;

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
     * @return Productdoc $this
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
     * Get integer
     *
     * @return integer
     */
    public function getNbrDownloads()
    {
        return $this->nbrDownloads;
    }

    /**
     * Set $nbrDownloads
     *
     * @param integer $nbrDownloads
     *
     * @return Productdoc $this
     */
    public function setNbrDownloads($nbrDownloads)
    {
        $this->nbrDownloads = $nbrDownloads;

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
     * @return Productdoc $this
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
     * @return Productdoc $this
     */
    public function setDtUpdate(\DateTime $dtUpdate = null)
    {
        $this->dtUpdate = $dtUpdate;

        return $this;
    }

    /**
     * Get Product
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set $product
     *
     * @param Product $product
     *
     * @return Productdoc $this
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }




    /**
     * Add i18ns
     *
     * @param ProductdocTrans $i18ns
     * @return Productdoc
     */
    public function addI18n(ProductdocTrans $i18ns)
    {
        $this->i18ns[] = $i18ns;

        return $this;
    }

    /**
     * Remove i18ns
     *
     * @param ProductdocTrans $i18ns
     * @return Productdoc
     */
    public function removeI18n(ProductdocTrans $i18ns)
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
     * @return Productdoc $this
     */
    public function setI18ns(Collection $i18ns)
    {
        $this->i18ns = $i18ns;

        return $this;
    }


}
