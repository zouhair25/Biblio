<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Typepret
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
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Pret", mappedBy="typepret")
     */
    private $pret;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pret = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Typepret
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
     * Add pret
     *
     * @param \PFE\DashBundle\Entity\Pret $pret
     * @return Typepret
     */
    public function addPret(\PFE\DashBundle\Entity\Pret $pret)
    {
        $this->pret[] = $pret;

        return $this;
    }

    /**
     * Remove pret
     *
     * @param \PFE\DashBundle\Entity\Pret $pret
     */
    public function removePret(\PFE\DashBundle\Entity\Pret $pret)
    {
        $this->pret->removeElement($pret);
    }

    /**
     * Get pret
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPret()
    {
        return $this->pret;
    }
}
