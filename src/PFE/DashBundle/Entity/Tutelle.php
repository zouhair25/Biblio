<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Tutelle
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     *@ORM\Column(type="datetime",nullable=true)
     */

    private $created;

    /**
     * @ORM\Column(type="string", nullable=true)
     */

    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity="PFE\DashBundle\Entity\Bibliotheque", inversedBy="tutelle")
     * @ORM\JoinTable(
     *     name="BibliothequeToTutelle",
     *     joinColumns={@ORM\JoinColumn(name="tutelle_id", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="bibliotheque_id", referencedColumnName="id", nullable=false)}
     * )
     */
    private $bibliotheque;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->created=new \DateTime();
        $this->bibliotheque = new \Doctrine\Common\Collections\ArrayCollection();

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
     * @return Tutelle
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
     * Add bibliotheque
     *
     * @param \PFE\DashBundle\Entity\Bibliotheque $bibliotheque
     * @return Tutelle
     */
    public function addBibliotheque(\PFE\DashBundle\Entity\Bibliotheque $bibliotheque)
    {
        $this->bibliotheque[] = $bibliotheque;

        return $this;
    }

    /**
     * Remove bibliotheque
     *
     * @param \PFE\DashBundle\Entity\Bibliotheque $bibliotheque
     */
    public function removeBibliotheque(\PFE\DashBundle\Entity\Bibliotheque $bibliotheque)
    {
        $this->bibliotheque->removeElement($bibliotheque);
    }

    /**
     * Get bibliotheque
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBibliotheque()
    {
        return $this->bibliotheque;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Tutelle
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
