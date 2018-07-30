<?php
namespace PFE\DashBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @ORM\Column(nullable=false)
     */
    private $nom;

    /**
    * @ORM\Column(type="string",length=50,nullable=false)
    * @Assert\File(mimeTypes={"image/png"})
    * @Assert\NotBlank(message="Séléctionnez une image !")
    */
    private $image;

    /**
     * @ORM\Column(nullable=false)
     * 
     * 
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

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return SocialMedia
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return SocialMedia
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
