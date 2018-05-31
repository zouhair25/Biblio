<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="InternetRepository")
 */
class Internet
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
    private $isDispo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Bibliotheque", inversedBy="internet")
     * @ORM\JoinColumn(name="bibliotheque_id", referencedColumnName="id", nullable=false)
     */
    private $bibliotheque;

    /**
     * Internet constructor.
     * @param $date
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
     * Set isDispo
     *
     * @param boolean $isDispo
     * @return Internet
     */
    public function setIsDispo($isDispo)
    {
        $this->isDispo = $isDispo;

        return $this;
    }

    /**
     * Get isDispo
     *
     * @return boolean 
     */
    public function getIsDispo()
    {
        return $this->isDispo;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Internet
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
     * Set bibliotheque
     *
     * @param \PFE\DashBundle\Entity\Bibliotheque $bibliotheque
     * @return Internet
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
     * @return Internet
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
