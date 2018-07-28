<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="PFE\DashBundle\Repository\EspaceRepository")
 */
class Espace
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\NotBlank()
     */
    private $isDisponible;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\Choice(choices = {"Bon", "Médiocre"}, message = "Choose a valid gender.")
     */
    private $etat;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank()
     */
    private $nombrePlaceAssises;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $created;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Equipement", mappedBy="espace")
     */
    private $equipement;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Typeespace", inversedBy="espace")
     * @ORM\JoinColumn(name="typeespace_id", referencedColumnName="id", nullable=false)
     */
    private $typeespace;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Bibliotheque", inversedBy="espace")
     * @ORM\JoinColumn(name="bibliotheque_id", referencedColumnName="id", nullable=false)
     */
    private $bibliotheque;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->equipement = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set isDisponible
     *
     * @param boolean $isDisponible
     * @return Espace
     */
    public function setIsDisponible($isDisponible)
    {
        $this->isDisponible = $isDisponible;

        return $this;
    }

    /**
     * Get isDisponible
     *
     * @return boolean 
     */
    public function getIsDisponible()
    {
        return $this->isDisponible;
    }

    /**
     * Set nombrePlaceAssises
     *
     * @param integer $nombrePlaceAssises
     * @return Espace
     */
    public function setNombrePlaceAssises($nombrePlaceAssises)
    {
        $this->nombrePlaceAssises = $nombrePlaceAssises;

        return $this;
    }

    /**
     * Get nombrePlaceAssises
     *
     * @return integer 
     */
    public function getNombrePlaceAssises()
    {
        return $this->nombrePlaceAssises;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Espace
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add equipement
     *
     * @param \PFE\DashBundle\Entity\Equipement $equipement
     * @return Espace
     */
    public function addEquipement(\PFE\DashBundle\Entity\Equipement $equipement)
    {
        $this->equipement[] = $equipement;

        return $this;
    }

    /**
     * Remove equipement
     *
     * @param \PFE\DashBundle\Entity\Equipement $equipement
     */
    public function removeEquipement(\PFE\DashBundle\Entity\Equipement $equipement)
    {
        $this->equipement->removeElement($equipement);
    }

    /**
     * Get equipement
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEquipement()
    {
        return $this->equipement;
    }

    /**
     * Set typeespace
     *
     * @param \PFE\DashBundle\Entity\Typeespace $typeespace
     * @return Espace
     */
    public function setTypeespace(\PFE\DashBundle\Entity\Typeespace $typeespace)
    {
        $this->typeespace = $typeespace;

        return $this;
    }

    /**
     * Get typeespace
     *
     * @return \PFE\DashBundle\Entity\Typeespace 
     */
    public function getTypeespace()
    {
        return $this->typeespace;
    }

    /**
     * Set bibliotheque
     *
     * @param \PFE\DashBundle\Entity\Bibliotheque $bibliotheque
     * @return Espace
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
     * Set etat
     *
     * @param boolean $etat
     * @return Espace
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return boolean 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Espace
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
