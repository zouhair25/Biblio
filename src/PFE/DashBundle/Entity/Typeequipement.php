<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Typeequipement
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isRayonnage;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Equipement", mappedBy="typeequipement")
     */
    private $equipement;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->equipement = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Typeequipement
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
     * Set isRayonnage
     *
     * @param boolean $isRayonnage
     * @return Typeequipement
     */
    public function setIsRayonnage($isRayonnage)
    {
        $this->isRayonnage = $isRayonnage;

        return $this;
    }

    /**
     * Get isRayonnage
     *
     * @return boolean 
     */
    public function getIsRayonnage()
    {
        return $this->isRayonnage;
    }

    /**
     * Add equipement
     *
     * @param \PFE\DashBundle\Entity\Equipement $equipement
     * @return Typeequipement
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
}
