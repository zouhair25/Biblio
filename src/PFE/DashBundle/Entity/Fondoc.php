<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="FondocRepository")
 */
class Fondoc
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $created;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Typefondoc", inversedBy="fondoc")
     * @ORM\JoinColumn(name="typefondoc_id", referencedColumnName="id", nullable=false)
     */
    private $typefondoc;

    /**
     * @ORM\OneToMany(targetEntity="PFE\DashBundle\Entity\Pret", mappedBy="fondoc")
     */
    private $pret;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Bibliotheque", inversedBy="fondoc")
     * @ORM\JoinColumn(name="bibliotheque_id", referencedColumnName="id", nullable=false)
     */
    private $bibliotheque;

    /**
     * Fondoc constructor.
     * @param $date
     */
    public function __construct()
    {
        $this->created = new \DateTime();
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
     * Set nombre
     *
     * @param integer $nombre
     * @return Fondoc
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
     * @return Fondoc
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
     * Set typefondoc
     *
     * @param \PFE\DashBundle\Entity\Typefondoc $typefondoc
     * @return Fondoc
     */
    public function setTypefondoc(\PFE\DashBundle\Entity\Typefondoc $typefondoc)
    {
        $this->typefondoc = $typefondoc;

        return $this;
    }

    /**
     * Get typefondoc
     *
     * @return \PFE\DashBundle\Entity\Typefondoc 
     */
    public function getTypefondoc()
    {
        return $this->typefondoc;
    }

    /**
     * Set bibliotheque
     *
     * @param \PFE\DashBundle\Entity\Bibliotheque $bibliotheque
     * @return Fondoc
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
     * @return Fondoc
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
     * Add pret
     *
     * @param \PFE\DashBundle\Entity\Pret $pret
     * @return Fondoc
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
