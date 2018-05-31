<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Typefondoc
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
    private $isMultimedia;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Fondoc", mappedBy="typefondoc")
     */
    private $fondoc;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fondoc = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Typefondoc
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
     * Set isMultimedia
     *
     * @param boolean $isMultimedia
     * @return Typefondoc
     */
    public function setIsMultimedia($isMultimedia)
    {
        $this->isMultimedia = $isMultimedia;

        return $this;
    }

    /**
     * Get isMultimedia
     *
     * @return boolean 
     */
    public function getIsMultimedia()
    {
        return $this->isMultimedia;
    }

    /**
     * Add fondoc
     *
     * @param \PFE\DashBundle\Entity\Fondoc $fondoc
     * @return Typefondoc
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

}
