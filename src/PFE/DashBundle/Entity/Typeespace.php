<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Typeespace
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
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Espace", mappedBy="typeespace")
     */
    private $espace;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->espace = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Typeespace
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
     * Add espace
     *
     * @param \PFE\DashBundle\Entity\Espace $espace
     * @return Typeespace
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
}
