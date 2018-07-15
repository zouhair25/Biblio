<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="PFE\DashBundle\Repository\BibliothequeRepository")
 * @UniqueEntity("email",message="Cet email est déjà utilisée.")
 * @UniqueEntity("nom",message="Cette bibliothèque est déjà saisie.")
 */
class Bibliotheque
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     * 
     * @Assert\Length(min=7,minMessage="Le nom doit faire au moins '{{ limit }}' caractères.")
     */
    private $nom;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date()
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Range(min=1)
     */
    private $superficie;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Length(min=10,max=10)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Length(min=10,max=10)
     *
     */
    private $fax;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas un email valide.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateInstallationInternet;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isFormation;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Miseajour", mappedBy="bibliotheque")
     */
    private $maj;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Internet", mappedBy="bibliotheque")
     */
    private $internet;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Fondoc", mappedBy="bibliotheque")
     */
    private $fondoc;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Animation", mappedBy="bibliotheque")
     */
    private $animation;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Espace", mappedBy="bibliotheque")
     */
    private $espace;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Adherent", mappedBy="bibliotheque")
     */
    private $adherent;

    /**
     * @ORM\OneToMany(targetEntity="PFE\UserBundle\Entity\User", mappedBy="bibliotheque")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="PFE\UserBundle\Entity\User", inversedBy="bibrespo")
     * @Assert\NotBlank()
     */
    private $responsable;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\SocialMedia", mappedBy="bibliotheque")
     */
    private $socialMedia;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Remarque", mappedBy="bibliotheque")
     */
    private $remarque;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Catalogue", inversedBy="bibliotheque")
     * @ORM\JoinColumn(name="catalogue_id", referencedColumnName="id")
     */
    private $catalogue;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Province", inversedBy="bibliotheque")
     * @ORM\JoinColumn(name="province_id", referencedColumnName="id", nullable=false)
     */
    private $province;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->internet = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fondoc = new \Doctrine\Common\Collections\ArrayCollection();
        $this->animation = new \Doctrine\Common\Collections\ArrayCollection();
        $this->espace = new \Doctrine\Common\Collections\ArrayCollection();
        $this->adherent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->socialMedia = new \Doctrine\Common\Collections\ArrayCollection();
        $this->remarque = new \Doctrine\Common\Collections\ArrayCollection();
        $this->isFormation = false;
        $this->dateCreation=new \DateTime();
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
     * Set nom
     *
     * @param string $nom
     * @return Bibliotheque
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Bibliotheque
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set superficie
     *
     * @param float $superficie
     * @return Bibliotheque
     */
    public function setSuperficie($superficie)
    {
        $this->superficie = $superficie;

        return $this;
    }

    /**
     * Get superficie
     *
     * @return float 
     */
    public function getSuperficie()
    {
        return $this->superficie;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Bibliotheque
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Bibliotheque
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Bibliotheque
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
     * Set email
     *
     * @param string $email
     * @return Bibliotheque
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateInstallationInternet
     *
     * @param \DateTime $dateInstallationInternet
     * @return Bibliotheque
     */
    public function setDateInstallationInternet($dateInstallationInternet)
    {
        $this->dateInstallationInternet = $dateInstallationInternet;

        return $this;
    }

    /**
     * Get dateInstallationInternet
     *
     * @return \DateTime 
     */
    public function getDateInstallationInternet()
    {
        return $this->dateInstallationInternet;
    }

    /**
     * Set isFormation
     *
     * @param boolean $isFormation
     * @return Bibliotheque
     */
    public function setIsFormation($isFormation)
    {
        $this->isFormation = $isFormation;

        return $this;
    }

    /**
     * Get isFormation
     *
     * @return boolean 
     */
    public function getIsFormation()
    {
        return $this->isFormation;
    }

    /**
     * Add internet
     *
     * @param \PFE\DashBundle\Entity\Internet $internet
     * @return Bibliotheque
     */
    public function addInternet(\PFE\DashBundle\Entity\Internet $internet)
    {
        $this->internet[] = $internet;

        return $this;
    }

    /**
     * Remove internet
     *
     * @param \PFE\DashBundle\Entity\Internet $internet
     */
    public function removeInternet(\PFE\DashBundle\Entity\Internet $internet)
    {
        $this->internet->removeElement($internet);
    }

    /**
     * Get internet
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInternet()
    {
        return $this->internet;
    }

    /**
     * Add fondoc
     *
     * @param \PFE\DashBundle\Entity\Fondoc $fondoc
     * @return Bibliotheque
     */
    public function addFondoc(\PFE\DashBundle\Entity\Fondoc $fondoc)
    {
        $this->fondoc[] = $fondoc;

        return $this;
    }

    /**
     * Remove fondoc
     *
     * @param \PFE\DashBundle\Entity\Fondoc $fondoc
     */
    public function removeFondoc(\PFE\DashBundle\Entity\Fondoc $fondoc)
    {
        $this->fondoc->removeElement($fondoc);
    }

    /**
     * Get fondoc
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFondoc()
    {
        return $this->fondoc;
    }

    /**
     * Add animation
     *
     * @param \PFE\DashBundle\Entity\Animation $animation
     * @return Bibliotheque
     */
    public function addAnimation(\PFE\DashBundle\Entity\Animation $animation)
    {
        $this->animation[] = $animation;

        return $this;
    }

    /**
     * Remove animation
     *
     * @param \PFE\DashBundle\Entity\Animation $animation
     */
    public function removeAnimation(\PFE\DashBundle\Entity\Animation $animation)
    {
        $this->animation->removeElement($animation);
    }

    /**
     * Get animation
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnimation()
    {
        return $this->animation;
    }

    /**
     * Add espace
     *
     * @param \PFE\DashBundle\Entity\Espace $espace
     * @return Bibliotheque
     */
    public function addEspace(\PFE\DashBundle\Entity\Espace $espace)
    {
        $this->espace[] = $espace;

        return $this;
    }

    /**
     * Remove espace
     *
     * @param \PFE\DashBundle\Entity\Espace $espace
     */
    public function removeEspace(\PFE\DashBundle\Entity\Espace $espace)
    {
        $this->espace->removeElement($espace);
    }

    /**
     * Get espace
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEspace()
    {
        return $this->espace;
    }

    /**
     * Add adherent
     *
     * @param \PFE\DashBundle\Entity\Adherent $adherent
     * @return Bibliotheque
     */
    public function addAdherent(\PFE\DashBundle\Entity\Adherent $adherent)
    {
        $this->adherent[] = $adherent;

        return $this;
    }

    /**
     * Remove adherent
     *
     * @param \PFE\DashBundle\Entity\Adherent $adherent
     */
    public function removeAdherent(\PFE\DashBundle\Entity\Adherent $adherent)
    {
        $this->adherent->removeElement($adherent);
    }

    /**
     * Get adherent
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdherent()
    {
        return $this->adherent;
    }

    /**
     * Add socialMedia
     *
     * @param \PFE\DashBundle\Entity\SocialMedia $socialMedia
     * @return Bibliotheque
     */
    public function addSocialMedia(\PFE\DashBundle\Entity\SocialMedia $socialMedia)
    {
        $this->socialMedia[] = $socialMedia;

        return $this;
    }

    /**
     * Remove socialMedia
     *
     * @param \PFE\DashBundle\Entity\SocialMedia $socialMedia
     */
    public function removeSocialMedia(\PFE\DashBundle\Entity\SocialMedia $socialMedia)
    {
        $this->socialMedia->removeElement($socialMedia);
    }

    /**
     * Get socialMedia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSocialMedia()
    {
        return $this->socialMedia;
    }

    /**
     * Add remarque
     *
     * @param \PFE\DashBundle\Entity\Remarque $remarque
     * @return Bibliotheque
     */
    public function addRemarque(\PFE\DashBundle\Entity\Remarque $remarque)
    {
        $this->remarque[] = $remarque;

        return $this;
    }

    /**
     * Remove remarque
     *
     * @param \PFE\DashBundle\Entity\Remarque $remarque
     */
    public function removeRemarque(\PFE\DashBundle\Entity\Remarque $remarque)
    {
        $this->remarque->removeElement($remarque);
    }

    /**
     * Get remarque
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRemarque()
    {
        return $this->remarque;
    }

    /**
     * Set catalogue
     *
     * @param \PFE\DashBundle\Entity\Catalogue $catalogue
     * @return Bibliotheque
     */
    public function setCatalogue(\PFE\DashBundle\Entity\Catalogue $catalogue = null)
    {
        $this->catalogue = $catalogue;

        return $this;
    }

    /**
     * Get catalogue
     *
     * @return \PFE\DashBundle\Entity\Catalogue 
     */
    public function getCatalogue()
    {
        return $this->catalogue;
    }

    /**
     * Set province
     *
     * @param \PFE\DashBundle\Entity\Province $province
     * @return Bibliotheque
     */
    public function setProvince(\PFE\DashBundle\Entity\Province $province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return \PFE\DashBundle\Entity\Province 
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Add user
     *
     * @param \PFE\UserBundle\Entity\User $user
     * @return Bibliotheque
     */
    public function addUser(\PFE\UserBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \PFE\UserBundle\Entity\User $user
     */
    public function removeUser(\PFE\UserBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add responsable
     *
     * @param \PFE\UserBundle\Entity\User $responsable
     * @return Bibliotheque
     */
    public function addResponsable(\PFE\UserBundle\Entity\User $responsable)
    {
        $this->responsable[] = $responsable;

        return $this;
    }

    /**
     * Remove responsable
     *
     * @param \PFE\UserBundle\Entity\User $responsable
     */
    public function removeResponsable(\PFE\UserBundle\Entity\User $responsable)
    {
        $this->responsable->removeElement($responsable);
    }

    /**
     * Get responsable
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Add maj
     *
     * @param \PFE\DashBundle\Entity\Miseajour $maj
     * @return Bibliotheque
     */
    public function addMaj(\PFE\DashBundle\Entity\Miseajour $maj)
    {
        $this->maj[] = $maj;

        return $this;
    }

    /**
     * Remove maj
     *
     * @param \PFE\DashBundle\Entity\Miseajour $maj
     */
    public function removeMaj(\PFE\DashBundle\Entity\Miseajour $maj)
    {
        $this->maj->removeElement($maj);
    }

    /**
     * Get maj
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMaj()
    {
        return $this->maj;
    }

    /**
     * Set responsable
     *
     * @param \PFE\UserBundle\Entity\User $responsable
     * @return Bibliotheque
     */
    public function setResponsable(\PFE\UserBundle\Entity\User $responsable = null)
    {
        $this->responsable = $responsable;

        return $this;
    }
}
