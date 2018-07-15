<?php
namespace PFE\DashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AdherentRepository")
 */
class Adherent
{


    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Length(min=7,max=255,minMessage="Le titre doit faire au moins 7 caracteres")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sexe;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateInscription;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Bibliotheque", inversedBy="adherent")
     * @ORM\JoinColumn(name="bibliotheque_id", referencedColumnName="id", nullable=false)
     */
    private $bibliotheque;

    /**
     * Adherent constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime();
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
     * @return Adherent
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
     * Set prenom
     *
     * @param string $prenom
     * @return Adherent
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return Adherent
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
        $this->age = date_diff(new \DateTime(), $dateNaissance)->y;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return Adherent
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set sexe
     *
     * @param boolean $sexe
     * @return Adherent
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return boolean 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     * @return Adherent
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime 
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set bibliotheque
     *
     * @param \PFE\DashBundle\Entity\Bibliotheque $bibliotheque
     * @return Adherent
     */
    public function setBibliotheque(\PFE\DashBundle\Entity\Bibliotheque $bibliotheque)
    {
        $this->bibliotheque = $bibliotheque;

        return $this;
    }

    /**
     * Get bibliotheque
     *
     * @return \PFE\DashBundle\Entity\Bibliotheque 
     */
    public function getBibliotheque()
    {
        return $this->bibliotheque;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Adherent
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }
}
