<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class SocialMedia
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(nullable=true)
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="PFE\DashBundle\Entity\Bibliotheque", inversedBy="socialMedia")
     * @ORM\JoinColumn(name="bibliotheque_id", referencedColumnName="id", nullable=false)
     */
    private $bibliotheque;

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
     * @return SocialMedia
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
     * Set url
     *
     * @param string $url
     * @return SocialMedia
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set bibliotheque
     *
     * @param \PFE\DashBundle\Entity\Bibliotheque $bibliotheque
     * @return SocialMedia
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
}
