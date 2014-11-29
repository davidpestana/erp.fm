<?php

namespace fm\mainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ialbums
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ialbums
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="keywords", type="string", length=255)
     */
    private $keywords;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_album", type="string", length=255)
     */
    private $descripcionAlbum;

    /**
     * @var string
     *
     * @ORM\Column(name="sevende", type="string", length=1)
     */
    private $sevende;

    /**
     * @var string
     *
     * @ORM\Column(name="publicar", type="string", length=1)
     */
    private $publicar;


   /**
     * @ORM\OneToMany(targetEntity="ifotos", mappedBy="album")
     */
    protected $fotos;

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
     * Set slug
     *
     * @param string $slug
     * @return ialbums
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     * @return ialbums
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    
        return $this;
    }

    /**
     * Get keywords
     *
     * @return string 
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return ialbums
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return ialbums
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set descripcionAlbum
     *
     * @param string $descripcionAlbum
     * @return ialbums
     */
    public function setDescripcionAlbum($descripcionAlbum)
    {
        $this->descripcionAlbum = $descripcionAlbum;
    
        return $this;
    }

    /**
     * Get descripcionAlbum
     *
     * @return string 
     */
    public function getDescripcionAlbum()
    {
        return $this->descripcionAlbum;
    }

    /**
     * Set sevende
     *
     * @param string $sevende
     * @return ialbums
     */
    public function setSevende($sevende)
    {
        $this->sevende = $sevende;
    
        return $this;
    }

    /**
     * Get sevende
     *
     * @return string 
     */
    public function getSevende()
    {
        return $this->sevende;
    }

    /**
     * Set publicar
     *
     * @param string $publicar
     * @return ialbums
     */
    public function setPublicar($publicar)
    {
        $this->publicar = $publicar;
    
        return $this;
    }

    /**
     * Get publicar
     *
     * @return string 
     */
    public function getPublicar()
    {
        return $this->publicar;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fotos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add fotos
     *
     * @param \fm\mainBundle\Entity\ifotos $fotos
     * @return ialbums
     */
    public function addFoto(\fm\mainBundle\Entity\ifotos $fotos)
    {
        $this->fotos[] = $fotos;
    
        return $this;
    }

    /**
     * Remove fotos
     *
     * @param \fm\mainBundle\Entity\ifotos $fotos
     */
    public function removeFoto(\fm\mainBundle\Entity\ifotos $fotos)
    {
        $this->fotos->removeElement($fotos);
    }

    /**
     * Get fotos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFotos()
    {
        return $this->fotos;
    }
}