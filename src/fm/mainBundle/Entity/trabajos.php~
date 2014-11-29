<?php

namespace fm\mainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * trabajos
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class trabajos
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
     * @ORM\Column(name="descripcion_corta", type="string", length=255)
     */
    private $descripcionCorta;

    /**
     * @var string
     *
     * @ORM\Column(name="familia", type="string", length=255)
     */
    private $familia;

    /**
     * @var string
     *
     * @ORM\Column(name="presentar", type="string", length=1)
     */
    private $presentar;


    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="fm\mainBundle\Entity\ialbums")
     */
    private $album;

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
     * @return trabajos
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
     * @return trabajos
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
     * @return trabajos
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
     * @return trabajos
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
     * Set descripcionCorta
     *
     * @param string $descripcionCorta
     * @return trabajos
     */
    public function setDescripcionCorta($descripcionCorta)
    {
        $this->descripcionCorta = $descripcionCorta;
    
        return $this;
    }

    /**
     * Get descripcionCorta
     *
     * @return string 
     */
    public function getDescripcionCorta()
    {
        return $this->descripcionCorta;
    }

    /**
     * Set familia
     *
     * @param string $familia
     * @return trabajos
     */
    public function setFamilia($familia)
    {
        $this->familia = $familia;
    
        return $this;
    }

    /**
     * Get familia
     *
     * @return string 
     */
    public function getFamilia()
    {
        return $this->familia;
    }

    /**
     * Set presentar
     *
     * @param string $presentar
     * @return trabajos
     */
    public function setPresentar($presentar)
    {
        $this->presentar = $presentar;
    
        return $this;
    }

    /**
     * Get presentar
     *
     * @return string 
     */
    public function getPresentar()
    {
        return $this->presentar;
    }

    /**
     * Set album
     *
     * @param \fm\mainBundle\Entity\ialbums $album
     * @return trabajos
     */
    public function setAlbum(\fm\mainBundle\Entity\ialbums $album = null)
    {
        $this->album = $album;
    
        return $this;
    }

    /**
     * Get album
     *
     * @return \fm\mainBundle\Entity\ialbums 
     */
    public function getAlbum()
    {
        return $this->album;
    }
}