<?php

namespace Alluco\DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Sasedev\Commons\SharedBundle\Validator as ExtraAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Encoder\Pbkdf2PasswordEncoder;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 * @ORM\Table(name="a_users")
 * @ORM\Entity(repositoryClass="Alluco\DataBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields={"username"}, message="profile.username.unique", errorPath="username", groups={"username"})
 * @UniqueEntity(fields={"email"}, message="profile.email.unique", errorPath="email", groups={"email"})
 */
class User implements UserInterface, \Serializable
{

    /**
     *
     * @var integer
     */
    const UT_ALONE = 1;

    /**
     *
     * @var integer
     */
    const UT_GROUP = 2;

    /**
     *
     * @var integer
     */
    const SEXE_MISS = 1;

    /**
     *
     * @var integer
     */
    const SEXE_MRS = 2;

    /**
     *
     * @var integer
     */
    const SEXE_MR = 3;

    /**
     *
     * @var integer
     */
    const LOCKOUT_UNLOCKED = 1;

    /**
     *
     * @var integer
     */
    const LOCKOUT_LOCKED = 2;

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
     * @ORM\Column(name="username", type="text", nullable=false, unique=true)
     * @Assert\Length(min = "3", max = "100", groups={"username"})
     * @Assert\Regex(pattern="/^[a-z0-9][a-z0-9_]+$/", groups={"username"})
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="text", nullable=true)
     * @Assert\Length(max="245", groups={"email"})
     * @Assert\Email(checkMX=true, checkHost=true, groups={"email"})
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="clearpassword", type="text", nullable=true)
     * @Assert\Length(min="8", max="200", groups={"clearPassword"})
     */
    protected $clearPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="passwd", type="text", nullable=true)
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="text", nullable=true)
     */
    protected $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="recoverycode", type="text", nullable=true)
     */
    protected $recoveryCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="recoveryexpiration", type="datetime", nullable=true)
     */
    protected $recoveryExpiration;

    /**
     * @var integer
     *
     * @ORM\Column(name="lockout", type="integer", nullable=false)
     * @Assert\Choice(callback="choiceLockoutCallback", groups={"lockout"})
     */
    protected $lockout;

    /**
     * @var integer
     *
     * @ORM\Column(name="logins", type="integer", nullable=false)
     */
    protected $logins;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastlogin", type="datetime", nullable=true)
     */
    protected $lastLogin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastactivity", type="datetime", nullable=true)
     */
    protected $lastActivity;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="text", nullable=true)
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="text", nullable=true)
     */
    protected $firstName;

    /**
     * @var integer
     *
     * @ORM\Column(name="sexe", type="integer", nullable=true)
     * @Assert\Choice(callback="choiceSexeCallback", groups={"sexe"})
     */
    protected $sexe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     * @Assert\Date(groups={"birthday"})
     */
    protected $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="strnum", type="text", nullable=true)
     * @Assert\Length(max="15", groups={"streetNum"})
     */
    protected $streetNum;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", nullable=true)
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="text", nullable=true)
     */
    protected $address2;

    /**
     * @var string
     *
     * @ORM\Column(name="town", type="text", nullable=true)
     * @Assert\Length(max="90", groups={"town"})
     */
    protected $town;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="text", nullable=true)
     * @Assert\Length(max="15", groups={"zipCode"})
     */
    protected $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="text", nullable=true)
     * @Assert\Country(groups={"country"})
     */
    protected $country;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="text", nullable=true)
     * @Assert\Length(max="25", groups={"fax"})
     * @ExtraAssert\Phone(groups={"fax"})
     */
    protected $fax;

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
     * @ORM\Column(name="mobile", type="text", nullable=true)
     * @Assert\Length(max="25", groups={"mobile"})
     * @ExtraAssert\Phone(groups={"mobile"})
     */
    protected $mobile;

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
     * @ORM\Column(name="fisc", type="text", nullable=true)
     * @Assert\Length(max="245", groups={"fisc"})
     */
    protected $fisc;

    /**
     * @var integer
     *
     * @ORM\Column(name="usertype", type="integer", nullable=false)
     * @Assert\Choice(callback="choiceUserTypeCallback", groups={"userType"})
     */
    protected $userType;

    /**
     * @var string
     *
     * @ORM\Column(name="otherinfo", type="text", nullable=true)
     */
    protected $otherInfos;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="text", nullable=true)
     */
    protected $avatar;

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
     * @var Job
     *
     * @ORM\ManyToOne(targetEntity="Job", inversedBy="users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="job_id", referencedColumnName="id")
     * })
     */
    protected $job;

    /**
     * @ORM\ManyToOne(targetEntity="Lang", inversedBy="users")
     * @ORM\JoinColumns({@ORM\JoinColumn(name="lang_id", referencedColumnName="id")})
     *
     * @var Lang $preferedLang
     */
    protected $preferedLang;

    /**
     *
     * @var Collection @ORM\OneToMany(targetEntity="Quotation", mappedBy="user", cascade={"persist", "remove"})
     * @ORM\OrderBy({"dtCrea" = "DESC"})
     */
    protected $quotations;

    /**
     *
     * @var Collection @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
     * @ORM\JoinTable(name="a_users_roles",
     *      joinColumns={
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *      },
     *      inverseJoinColumns={
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     *      }
     *      )
     */
    protected $userRoles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setDtCrea(new \DateTime('now'));

        $this->setUserType(self::UT_ALONE);

        $this->setLockout(self::LOCKOUT_UNLOCKED);

        $this->setSexe(self::SEXE_MR);

        $this->setLogins(0);

        $this->setSalt(md5(uniqid(null, true)));

        $this->setClearPassword(
            self::generateRandomChar(8, 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'));

        $this->setUserRoles(new ArrayCollection());

        $this->setQuotations(new ArrayCollection());
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
     * Get $username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set $username
     *
     * @param string $username
     *
     * @return User $this
     */
    public function setUsername($username)
    {
        $this->username = strtolower(str_replace(' ', '.', trim($username)));

        return $this;
    }

    /**
     * Get $email
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
     * @return User $this
     */
    public function setEmail($email)
    {
        $this->email = strtolower(trim($email));

        return $this;
    }

    /**
     * Get $clearPassword
     *
     * @return string
     */
    public function getClearPassword()
    {
        return $this->clearPassword;
    }

    /**
     * Set $clearPassword
     *
     * @param string $clearPassword
     *
     * @return User $this
     */
    public function setClearPassword($clearPassword)
    {
        $this->clearPassword = $clearPassword;

        return $this->setPassword($clearPassword);
    }

    /**
     * Get $password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set $password
     *
     * @param string $password
     *
     * @return User $this
     */
    public function setPassword($password)
    {
        $encoder = new Pbkdf2PasswordEncoder('sha512', true, 1000);
        $this->password = $encoder->encodePassword($password, $this->getSalt());

        return $this;
    }

    /**
     * Get $salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set $salt
     *
     * @param string $salt
     *
     * @return User $this
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get $recoveryCode
     *
     * @return string
     */
    public function getRecoveryCode()
    {
        return $this->recoveryCode;
    }

    /**
     * Set $recoveryCode
     *
     * @param string $recoveryCode
     *
     * @return User $this
     */
    public function setRecoveryCode($recoveryCode)
    {
        $this->recoveryCode = $recoveryCode;

        return $this;
    }

    /**
     * Get $recoveryExpiration
     *
     * @return \DateTime
     */
    public function getRecoveryExpiration()
    {
        return $this->recoveryExpiration;
    }

    /**
     * Set $recoveryExpiration
     *
     * @param \DateTime $recoveryExpiration
     *
     * @return User $this
     */
    public function setRecoveryExpiration(\DateTime $recoveryExpiration = null)
    {
        $this->recoveryExpiration = $recoveryExpiration;

        return $this;
    }

    /**
     * Get $lockout
     *
     * @return integer
     */
    public function getLockout()
    {
        return $this->lockout;
    }

    /**
     * Set $lockout
     *
     * @param integer $lockout
     *
     * @return User $this
     */
    public function setLockout($lockout)
    {
        $this->lockout = $lockout;

        return $this;
    }

    /**
     * Get $logins
     *
     * @return integer
     */
    public function getLogins()
    {
        return $this->logins;
    }

    /**
     * Set $logins
     *
     * @param integer $logins
     *
     * @return User $this
     */
    public function setLogins($logins)
    {
        $this->logins = $logins;

        return $this;
    }

    /**
     * Get $lastLogin
     *
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set $lastLogin
     *
     * @param \DateTime $lastLogin
     *
     * @return User $this
     */
    public function setLastLogin(\DateTime $lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get $lastActivity
     *
     * @return \DateTime
     */
    public function getLastActivity()
    {
        return $this->lastActivity;
    }

    /**
     * Set $lastActivity
     *
     * @param \DateTime $lastActivity
     *
     * @return User $this
     */
    public function setLastActivity(\DateTime $lastActivity)
    {
        $this->lastActivity = $lastActivity;

        return $this;
    }

    /**
     * Get $lastName
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
     * @return User $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get $firstName
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
     * @return User $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get $sexe
     *
     * @return integer
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set $sexe
     *
     * @param integer $sexe
     *
     * @return User $this
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get $birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set $birthday
     *
     * @param \DateTime $birthday
     *
     * @return User $this
     */
    public function setBirthday(\DateTime $birthday = null)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get $streetNum
     *
     * @return string
     */
    public function getStreetNum()
    {
        return $this->streetNum;
    }

    /**
     * Set $streetNum
     *
     * @param string $streetNum
     *
     * @return User $this
     */
    public function setStreetNum($streetNum)
    {
        $this->streetNum = $streetNum;

        return $this;
    }

    /**
     * Get $address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set $address
     *
     * @param string $address
     *
     * @return User $this
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get $address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set $address2
     *
     * @param string $address2
     *
     * @return User $this
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get $town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set $town
     *
     * @param string $town
     *
     * @return User $this
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get $zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set $zipCode
     *
     * @param string $zipCode
     *
     * @return User $this
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get $country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set $country
     *
     * @param string $country
     *
     * @return User $this
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get $phone
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
     * @return User $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get $mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set $mobile
     *
     * @param string $mobile
     *
     * @return User $this
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get $avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set $avatar
     *
     * @param string $avatar
     *
     * @return User $this
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

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
     * @return User $this
     */
    public function setDtCrea(\DateTime $dtCrea = null)
    {
        $this->dtCrea = $dtCrea;

        return $this;
    }

    /**
     * Get $dtUpdate
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
     * @return User $this
     */
    public function setDtUpdate(\DateTime $dtUpdate = null)
    {
        $this->dtUpdate = $dtUpdate;

        return $this;
    }

    /**
     * Get $preferedLang
     *
     * @return Lang
     */
    public function getPreferedLang()
    {
        return $this->preferedLang;
    }

    /**
     * Set $preferedLang
     *
     * @param Lang $preferedLang
     *
     * @return User $this
     */
    public function setPreferedLang(Lang $preferedLang = null)
    {
        $this->preferedLang = $preferedLang;

        return $this;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return User
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return User
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set fisc
     *
     * @param string $fisc
     * @return User
     */
    public function setFisc($fisc)
    {
        $this->fisc = $fisc;

        return $this;
    }

    /**
     * Get fisc
     *
     * @return string
     */
    public function getFisc()
    {
        return $this->fisc;
    }

    /**
     * Set userType
     *
     * @param integer $userType
     * @return User
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;

        return $this;
    }

    /**
     * Get userType
     *
     * @return integer
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * Set otherInfos
     *
     * @param string $otherInfos
     * @return User
     */
    public function setOtherInfos($otherInfos)
    {
        $this->otherInfos = $otherInfos;

        return $this;
    }

    /**
     * Get otherInfos
     *
     * @return string
     */
    public function getOtherInfos()
    {
        return $this->otherInfos;
    }

    /**
     * Set job
     *
     * @param Job $job
     * @return User
     */
    public function setJob(Job $job = null)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return Job
     */
    public function getJob()
    {
        return $this->job;
    }


    /**
     * Add quotations
     *
     * @param Quotation $quotations
     * @return User
     */
    public function addQuotation(Quotation $quotations)
    {
        $this->quotations[] = $quotations;

        return $this;
    }

    /**
     * Remove quotations
     *
     * @param Quotation $quotations
     * @return User
     */
    public function removeQuotation(Quotation $quotations)
    {
        $this->quotations->removeElement($quotations);

        return $this;
    }

    /**
     * Get quotations
     *
     * @return ArrayCollection
     */
    public function getQuotations()
    {
        return $this->quotations;
    }

    /**
     * Get quotations
     *
     * @param Collection $quotations
     */
    public function setQuotations(Collection $quotations)
    {
        $this->quotations = $quotations;

        return $this;
    }

    /**
     * Get $userRoles
     *
     * @return ArrayCollection
     */
    public function getUserRoles()
    {
        return $this->userRoles;
    }

    /**
     * Set $userRoles
     *
     * @param Collection $userRoles
     *
     * @return User
     */
    public function setUserRoles(Collection $userRoles)
    {
        $this->userRoles = $userRoles;

        return $this;
    }

    /**
     * Add $role
     *
     * @param Role $role
     *
     * @return User
     */
    public function addUserRole(Role $role)
    {
        $this->userRoles[] = $role;

        return $this;
    }

    /**
     * Remove $role
     *
     * @param Role $role
     *
     * @return User
     */
    public function removeUserRole(Role $role)
    {
        $this->userRoles->removeElement($role);

        return $this;
    }

    /*
     * (non-PHPdoc) @see \Symfony\Component\Security\Core\User\UserInterface::getRoles()
     */
    public function getRoles()
    {
        return $this->userRoles->toArray();
    }

    /**
     * Get calculated fullName From username, firstName and lastName
     *
     * @return string
     */
    public function getFullName()
    {
        if (null == $this->getFirstName() && null == $this->getLastName()) {
            return $this->getUsername();
        } elseif (null != $this->getFirstName() && null != $this->getLastName()) {
            return $this->getFirstName() . " " . $this->getLastName();
        } else {
            if (null != $this->getLastName()) {
                return $this->getLastName();
            }
            if (null != $this->getFirstName()) {
                return $this->getFirstName();
            }
        }
    }

    /**
     * Set the lastActivity to now
     *
     * @return User
     */
    public function isActiveNow()
    {
        return $this->setLastActivity(new \DateTime());
    }

    /**
     * Erases the user credentials.
     * (non-PHPdoc) @see \Symfony\Component\Security\Core\User\UserInterface::eraseCredentials()
     */
    public function eraseCredentials()
    {
        // $this->clearPassword = null;
    }

    /**
     * Serializes the User.
     * The serialized data have to contain the fields used by the equals method
     * and the username.
     * (non-PHPdoc) @see Serializable::serialize()
     *
     * @return string
     */
    public function serialize()
    {
        return serialize(array($this->password, $this->salt, $this->username, $this->email, $this->lockout, $this->id));
    }

    /**
     * Unserializes the User.
     * (non-PHPdoc) @see Serializable::unserialize()
     *
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        // add a few extra elements in the array to ensure that we have enough
        // keys when
        // unserializing
        // older data which does not include all properties.
        $data = array_merge($data, array_fill(0, 2, null));

        list ($this->password, $this->salt, $this->username, $this->email, $this->lockout, $this->id) = $data;
    }

    /**
     * Choice Form userType
     *
     * @return multitype:string
     */
    public static function choiceUserType()
    {
        return array(self::UT_ALONE => 'User.userType.choice.' . self::UT_ALONE,
            self::UT_GROUP => 'User.userType.choice.' . self::UT_GROUP);
    }

    /**
     * Choice Validator lockout
     *
     * @return multitype:string
     */
    public static function choiceUserTypeCallback()
    {
        return array(self::UT_ALONE, self::UT_GROUP);
    }

    /**
     * Choice Form lockout
     *
     * @return multitype:string
     */
    public static function choiceLockout()
    {
        return array(self::LOCKOUT_UNLOCKED => 'User.lockout.choice.' . self::LOCKOUT_UNLOCKED,
            self::LOCKOUT_LOCKED => 'User.lockout.choice.' . self::LOCKOUT_LOCKED);
    }

    /**
     * Choice Validator lockout
     *
     * @return multitype:string
     */
    public static function choiceLockoutCallback()
    {
        return array(self::LOCKOUT_UNLOCKED, self::LOCKOUT_LOCKED);
    }

    /**
     * Choice Form sexe
     *
     * @return multitype:string
     */
    public static function choiceSexe()
    {
        return array(self::SEXE_MISS => 'User.sexe.choice.' . self::SEXE_MISS,
            self::SEXE_MRS => 'User.sexe.choice.' . self::SEXE_MRS, self::SEXE_MR => 'User.sexe.choice.' . self::SEXE_MR);
    }

    /**
     * Choice Validator sexe
     *
     * @return multitype:integer
     */
    public static function choiceSexeCallback()
    {
        return array(self::SEXE_MISS, self::SEXE_MRS, self::SEXE_MR);
    }

    /**
     * Get a random char (for generated password)
     *
     * @param integer $length
     * @param string $charset
     *
     * @return string
     */
    public static function generateRandomChar($length,
        $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789#@!?+=*/-')
    {
        $str = '';
        $count = strlen($charset);
        while ($length --) {
            $str .= $charset[mt_rand(0, $count - 1)];
        }

        return $str;
    }
}
