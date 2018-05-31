<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="EquipementRepository")
 */
class Equipement
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDisponible=1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombre_endommage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombre_nutilisable;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Typeequipement", inversedBy="equipement")
     * @ORM\JoinColumn(name="typeequipement_id", referencedColumnName="id", nullable=false)
     */
    private $typeequipement;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Espace", inversedBy="equipement")
     * @ORM\JoinColumn(name="espace_id", referencedColumnName="id", nullable=false)
     */
    private $espace;

    /**
     * Equipement constructor.
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
     * Set isDisponible
     *
     * @param boolean $isDisponible
     * @return Equipement
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
     * Set nombre
     *
     * @param integer $nombre
     * @return Equipement
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return integer 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Equipement
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
     * Set typeequipement
     *
     * @param \PFE\DashBundle\Entity\Typeequipement $typeequipement
     * @return Equipement
     */
    public function setTypeequipement(\PFE\DashBundle\Entity\Typeequipement $typeequipement)
    {
        $this->typeequipement = $typeequipement;

        return $this;
    }

    /**
     * Get typeequipement
     *
     * @return \PFE\DashBundle\Entity\Typeequipement 
     */
    public function getTypeequipement()
    {
        return $this->typeequipement;
    }

    /**
     * Set espace
     *
     * @param \PFE\DashBundle\Entity\Espace $espace
     * @return Equipement
     */
    public function setEspace(\PFE\DashBundle\Entity\Espace $espace)
    {
        $this->espace = $espace;

        return $this;
    }

    /**
     * Get espace
     *
     * @return \PFE\DashBundle\Entity\Espace 
     */
    public function getEspace()
    {
        return $this->espace;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Equipement
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

    /**
     * Set nombre_endommage
     *
     * @param integer $nombreEndommage
     * @return Equipement
     */
    public function setNombreEndommage($nombreEndommage)
    {
        $this->nombre_endommage = $nombreEndommage;

        return $this;
    }

    /**
     * Get nombre_endommage
     *
     * @return integer 
     */
    public function getNombreEndommage()
    {
        return $this->nombre_endommage;
    }

    /**
     * Set nombre_nutilisable
     *
     * @param integer $nombreNutilisable
     * @return Equipement
     */
    public function setNombreNutilisable($nombreNutilisable)
    {
        $this->nombre_nutilisable = $nombreNutilisable;

        return $this;
    }

    /**
     * Get nombre_nutilisable
     *
     * @return integer 
     */
    public function getNombreNutilisable()
    {
        return $this->nombre_nutilisable;
    }
}
