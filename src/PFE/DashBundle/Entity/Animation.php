<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PFE\DashBundle\Repository\AnimationRepository")
 */
class Animation
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $occamenheb;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $publicvise;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateExposition;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $publicTotal;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateanimation;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Typeanimation", inversedBy="animation")
     * @ORM\JoinColumn(name="typeanimation_id", referencedColumnName="id", nullable=false)
     */
    private $typeanimation;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Bibliotheque", inversedBy="animation")
     * @ORM\JoinColumn(name="bibliotheque_id", referencedColumnName="id", nullable=false)
     */
    private $bibliotheque;

    /**
     * Animation constructor.
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
     * Set occamenheb
     *
     * @param integer $occamenheb
     * @return Animation
     */
    public function setOccamenheb($occamenheb)
    {
        $this->occamenheb = $occamenheb;

        return $this;
    }

    /**
     * Get occamenheb
     *
     * @return integer 
     */
    public function getOccamenheb()
    {
        return $this->occamenheb;
    }

    /**
     * Set publicvise
     *
     * @param integer $publicvise
     * @return Animation
     */
    public function setPublicvise($publicvise)
    {
        $this->publicvise = $publicvise;

        return $this;
    }

    /**
     * Get publicvise
     *
     * @return integer 
     */
    public function getPublicvise()
    {
        return $this->publicvise;
    }

    /**
     * Set dateExposition
     *
     * @param \DateTime $dateExposition
     * @return Animation
     */
    public function setDateExposition($dateExposition)
    {
        $this->dateExposition = $dateExposition;

        return $this;
    }

    /**
     * Get dateExposition
     *
     * @return \DateTime 
     */
    public function getDateExposition()
    {
        return $this->dateExposition;
    }

    /**
     * Set publicTotal
     *
     * @param integer $publicTotal
     * @return Animation
     */
    public function setPublicTotal($publicTotal)
    {
        $this->publicTotal = $publicTotal;

        return $this;
    }

    /**
     * Get publicTotal
     *
     * @return integer 
     */
    public function getPublicTotal()
    {
        return $this->publicTotal;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Animation
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
     * Set typeanimation
     *
     * @param \PFE\DashBundle\Entity\Typeanimation $typeanimation
     * @return Animation
     */
    public function setTypeanimation(\PFE\DashBundle\Entity\Typeanimation $typeanimation)
    {
        $this->typeanimation = $typeanimation;

        return $this;
    }

    /**
     * Get typeanimation
     *
     * @return \PFE\DashBundle\Entity\Typeanimation 
     */
    public function getTypeanimation()
    {
        return $this->typeanimation;
    }

    /**
     * Set bibliotheque
     *
     * @param \PFE\DashBundle\Entity\Bibliotheque $bibliotheque
     * @return Animation
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
     * Set dateanimation
     *
     * @param \DateTime $dateanimation
     * @return Animation
     */
    public function setDateanimation($dateanimation)
    {
        $this->dateanimation = $dateanimation;

        return $this;
    }

    /**
     * Get dateanimation
     *
     * @return \DateTime 
     */
    public function getDateanimation()
    {
        return $this->dateanimation;
    }

}
