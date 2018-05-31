<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Typeanimation
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
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Animation", mappedBy="typeanimation")
     */
    private $animation;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->animation = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Typeanimation
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
     * Add animation
     *
     * @param \PFE\DashBundle\Entity\Animation $animation
     * @return Typeanimation
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
}
