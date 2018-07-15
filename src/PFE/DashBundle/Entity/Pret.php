<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PFE\DashBundle\Repository\PretRepository")
 */
class Pret
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
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Typepret", inversedBy="pret")
     * @ORM\JoinColumn(name="typepret_id", referencedColumnName="id", nullable=false)
     */
    private $typepret;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Fondoc", inversedBy="pret")
     * @ORM\JoinColumn(name="fondoc_id", referencedColumnName="id", nullable=false)
     */
    private $fondoc;

    /**
     * Pret constructor.
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
     * Set description
     *
     * @param string $description
     * @return Pret
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set nombre
     *
     * @param integer $nombre
     * @return Pret
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
     * @return Pret
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
     * Set typepret
     *
     * @param \PFE\DashBundle\Entity\Typepret $typepret
     * @return Pret
     */
    public function setTypepret(\PFE\DashBundle\Entity\Typepret $typepret)
    {
        $this->typepret = $typepret;

        return $this;
    }

    /**
     * Get typepret
     *
     * @return \PFE\DashBundle\Entity\Typepret 
     */
    public function getTypepret()
    {
        return $this->typepret;
    }

    /**
     * Set fondoc
     *
     * @param \PFE\DashBundle\Entity\Fondoc $fondoc
     * @return Pret
     */
    public function setFondoc(\PFE\DashBundle\Entity\Fondoc $fondoc)
    {
        $this->fondoc = $fondoc;

        return $this;
    }

    /**
     * Get fondoc
     *
     * @return \PFE\DashBundle\Entity\Fondoc
     */
    public function getFondoc()
    {
        return $this->fondoc;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Pret
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
