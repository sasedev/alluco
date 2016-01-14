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
 * @ORM\Table(name="a_langs")
 * @ORM\Entity(repositoryClass="Alluco\DataBundle\Repository\LangRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"locale"}, errorPath="locale", groups={"locale"})
 */
class Lang
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
     * @ORM\Column(name="locale", type="text", nullable=false, unique=true)
     * @Assert\Locale(groups={"locale"})
     */
    protected $locale;

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
     * @var Collection @ORM\OneToMany(targetEntity="User", mappedBy="preferedLang", cascade={"persist", "remove"})
     * @ORM\OrderBy({"username" = "ASC"})
     */
    protected $users;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="JobTrans", mappedBy="lang", cascade={"persist", "remove"})
     */
    protected $jobI18ns;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="BannerTrans", mappedBy="lang", cascade={"persist", "remove"})
     */
    protected $bannerI18ns;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="CertifTrans", mappedBy="lang", cascade={"persist", "remove"})
     */
    protected $certifI18ns;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="StaticpageTrans", mappedBy="lang", cascade={"persist", "remove"})
     */
    protected $staticpageI18ns;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="SitenewTrans", mappedBy="lang", cascade={"persist", "remove"})
     */
    protected $sitenewI18ns;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="ProductTrans", mappedBy="lang", cascade={"persist", "remove"})
     */
    protected $productI18ns;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="ProductpicTrans", mappedBy="lang", cascade={"persist", "remove"})
     */
    protected $productpicI18ns;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="ProductdocTrans", mappedBy="lang", cascade={"persist", "remove"})
     */
    protected $productdocI18ns;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setStatus(self::ST_DISABLED);

        $this->setDtCrea(new \DateTime('now'));

        $this->setUsers(new ArrayCollection());

        $this->setJobI18ns(new ArrayCollection());

        $this->setBannerI18ns(new ArrayCollection());

        $this->setCertifI18ns(new ArrayCollection());

        $this->setStaticpageI18ns(new ArrayCollection());

        $this->setSitenewI18ns(new ArrayCollection());

        $this->setProductI18ns(new ArrayCollection());

        $this->setProductpicI18ns(new ArrayCollection());

        $this->setProductdocI18ns(new ArrayCollection());
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
     * Get $locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set $locale
     *
     * @param string $locale
     *
     * @return Lang $this
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get $name
     *
     * @return string
     */
    public function getName()
    {
        return \ucfirst(\Locale::getDisplayName($this->locale, $this->locale));
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
     * @return Lang $this
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
     * @return Lang $this
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
     * @return Lang $this
     */
    public function setDtUpdate(\DateTime $dtUpdate = null)
    {
        $this->dtUpdate = $dtUpdate;

        return $this;
    }

    /**
     * Add $user
     *
     * @param User $user
     *
     * @return Lang $this
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
     * @return Lang $this
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);

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
     * @return Lang $this
     */
    public function setUsers(Collection $users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Add jobI18ns
     *
     * @param JobTrans $jobI18ns
     * @return Lang
     */
    public function addJobI18n(JobTrans $jobI18ns)
    {
        $this->jobI18ns[] = $jobI18ns;

        return $this;
    }

    /**
     * Remove jobI18ns
     *
     * @param JobTrans $jobI18ns
     * @return Lang
     */
    public function removeJobI18n(JobTrans $jobI18ns)
    {
        $this->jobI18ns->removeElement($jobI18ns);

        return $this;
    }

    /**
     * Get jobI18ns
     *
     * @return ArrayCollection
     */
    public function getJobI18ns()
    {
        return $this->jobI18ns;
    }

    /**
     * Set $jobI18ns
     *
     * @param Collection $jobI18ns
     *
     * @return Lang $this
     */
    public function setJobI18ns(Collection $jobI18ns)
    {
        $this->jobI18ns = $jobI18ns;

        return $this;
    }

    /**
     * Add bannerI18ns
     *
     * @param BannerTrans $bannerI18ns
     * @return Lang
     */
    public function addBannerI18n(BannerTrans $bannerI18ns)
    {
        $this->bannerI18ns[] = $bannerI18ns;

        return $this;
    }

    /**
     * Remove bannerI18ns
     *
     * @param BannerTrans $bannerI18ns
     * @return Lang
     */
    public function removeBannerI18n(BannerTrans $bannerI18ns)
    {
        $this->bannerI18ns->removeElement($bannerI18ns);

        return $this;
    }

    /**
     * Get bannerI18ns
     *
     * @return ArrayCollection
     */
    public function getBannerI18ns()
    {
        return $this->bannerI18ns;
    }

    /**
     * Set $bannerI18ns
     *
     * @param Collection $bannerI18ns
     *
     * @return Lang $this
     */
    public function setBannerI18ns(Collection $bannerI18ns)
    {
        $this->bannerI18ns = $bannerI18ns;

        return $this;
    }

    /**
     * Add certifI18ns
     *
     * @param CertifTrans $certifI18ns
     * @return Lang
     */
    public function addCertifI18n(CertifTrans $certifI18ns)
    {
        $this->certifI18ns[] = $certifI18ns;

        return $this;
    }

    /**
     * Remove certifI18ns
     *
     * @param CertifTrans $certifI18ns
     * @return Lang
     */
    public function removeCertifI18n(CertifTrans $certifI18ns)
    {
        $this->certifI18ns->removeElement($certifI18ns);

        return $this;
    }

    /**
     * Get certifI18ns
     *
     * @return ArrayCollection
     */
    public function getCertifI18ns()
    {
        return $this->certifI18ns;
    }

    /**
     * Set $certifI18ns
     *
     * @param Collection $certifI18ns
     *
     * @return Lang $this
     */
    public function setCertifI18ns(Collection $certifI18ns)
    {
        $this->certifI18ns = $certifI18ns;

        return $this;
    }

    /**
     * Add staticpageI18ns
     *
     * @param StaticpageTrans $staticpageI18ns
     * @return Lang
     */
    public function addStaticpageI18n(StaticpageTrans $staticpageI18ns)
    {
        $this->staticpageI18ns[] = $staticpageI18ns;

        return $this;
    }

    /**
     * Remove staticpageI18ns
     *
     * @param StaticpageTrans $staticpageI18ns
     * @return Lang
     */
    public function removeStaticpageI18n(StaticpageTrans $staticpageI18ns)
    {
        $this->staticpageI18ns->removeElement($staticpageI18ns);

        return $this;
    }

    /**
     * Get staticpageI18ns
     *
     * @return ArrayCollection
     */
    public function getStaticpageI18ns()
    {
        return $this->staticpageI18ns;
    }

    /**
     * Set $staticpageI18ns
     *
     * @param Collection $staticpageI18ns
     *
     * @return Lang $this
     */
    public function setStaticpageI18ns(Collection $staticpageI18ns)
    {
        $this->staticpageI18ns = $staticpageI18ns;

        return $this;
    }

    /**
     * Add sitenewI18ns
     *
     * @param SitenewTrans $sitenewI18ns
     * @return Lang
     */
    public function addSitenewI18n(SitenewTrans $sitenewI18ns)
    {
        $this->sitenewI18ns[] = $sitenewI18ns;

        return $this;
    }

    /**
     * Remove sitenewI18ns
     *
     * @param SitenewTrans $sitenewI18ns
     * @return Lang
     */
    public function removeSitenewI18n(SitenewTrans $sitenewI18ns)
    {
        $this->sitenewI18ns->removeElement($sitenewI18ns);

        return $this;
    }

    /**
     * Get sitenewI18ns
     *
     * @return ArrayCollection
     */
    public function getSitenewI18ns()
    {
        return $this->sitenewI18ns;
    }

    /**
     * Set $sitenewI18ns
     *
     * @param Collection $sitenewI18ns
     *
     * @return Lang $this
     */
    public function setSitenewI18ns(Collection $sitenewI18ns)
    {
        $this->sitenewI18ns = $sitenewI18ns;

        return $this;
    }

    /**
     * Add productI18ns
     *
     * @param ProductTrans $productI18ns
     * @return Lang
     */
    public function addProductI18n(ProductTrans $productI18ns)
    {
        $this->productI18ns[] = $productI18ns;

        return $this;
    }

    /**
     * Remove productI18ns
     *
     * @param ProductTrans $productI18ns
     * @return Lang
     */
    public function removeProductI18n(ProductTrans $productI18ns)
    {
        $this->productI18ns->removeElement($productI18ns);

        return $this;
    }

    /**
     * Get productI18ns
     *
     * @return ArrayCollection
     */
    public function getProductI18ns()
    {
        return $this->productI18ns;
    }

    /**
     * Set $productI18ns
     *
     * @param Collection $productI18ns
     *
     * @return Lang $this
     */
    public function setProductI18ns(Collection $productI18ns)
    {
        $this->productI18ns = $productI18ns;

        return $this;
    }

    /**
     * Add productpicI18ns
     *
     * @param ProductpicTrans $productpicI18ns
     * @return Lang
     */
    public function addProductpicI18n(ProductpicTrans $productpicI18ns)
    {
        $this->productpicI18ns[] = $productpicI18ns;

        return $this;
    }

    /**
     * Remove productpicI18ns
     *
     * @param ProductpicTrans $productpicI18ns
     * @return Lang
     */
    public function removeProductpicI18n(ProductpicTrans $productpicI18ns)
    {
        $this->productpicI18ns->removeElement($productpicI18ns);

        return $this;
    }

    /**
     * Get productpicI18ns
     *
     * @return ArrayCollection
     */
    public function getProductpicI18ns()
    {
        return $this->productpicI18ns;
    }

    /**
     * Set $productpicI18ns
     *
     * @param Collection $productpicI18ns
     *
     * @return Lang $this
     */
    public function setProductpicI18ns(Collection $productpicI18ns)
    {
        $this->productpicI18ns = $productpicI18ns;

        return $this;
    }

    /**
     * Add productdocI18ns
     *
     * @param ProductdocTrans $productdocI18ns
     * @return Lang
     */
    public function addProductdocI18n(ProductdocTrans $productdocI18ns)
    {
        $this->productdocI18ns[] = $productdocI18ns;

        return $this;
    }

    /**
     * Remove productdocI18ns
     *
     * @param ProductdocTrans $productdocI18ns
     * @return Lang
     */
    public function removeProductdocI18n(ProductdocTrans $productdocI18ns)
    {
        $this->productdocI18ns->removeElement($productdocI18ns);

        return $this;
    }

    /**
     * Get productdocI18ns
     *
     * @return ArrayCollection
     */
    public function getProductdocI18ns()
    {
        return $this->productdocI18ns;
    }

    /**
     * Set $productdocI18ns
     *
     * @param Collection $productdocI18ns
     *
     * @return Lang $this
     */
    public function setProductdocI18ns(Collection $productdocI18ns)
    {
        $this->productdocI18ns = $productdocI18ns;

        return $this;
    }

    /**
     * Choice Form status
     *
     * @return multitype:string
     */
    public static function choiceStatus()
    {
        return array(self::ST_DISABLED => 'Lang.status.choice.' . self::ST_DISABLED,
            self::ST_ENABLED => 'Lang.status.choice.' . self::ST_ENABLED);
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
