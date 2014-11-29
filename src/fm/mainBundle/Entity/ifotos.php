<?php

namespace fm\mainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ifotos
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ifotos
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
     * @ORM\Column(name="descripcion_larga", type="text")
     */
    private $descripcionLarga;

    /**
     * @var string
     *
     * @ORM\Column(name="icono", type="string", length=255)
     */
    private $icono;

    /**
     * @var string
     *
     * @ORM\Column(name="miniatura", type="string", length=255)
     */
    private $miniatura;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255)
     */
    private $foto;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="fm\mainBundle\Entity\ialbums",inversedBy="fotos")
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
     * @return ifotos
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
     * @return ifotos
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
     * @return ifotos
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
     * @return ifotos
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
     * @return ifotos
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
     * Set descripcionLarga
     *
     * @param string $descripcionLarga
     * @return ifotos
     */
    public function setDescripcionLarga($descripcionLarga)
    {
        $this->descripcionLarga = $descripcionLarga;
    
        return $this;
    }

    /**
     * Get descripcionLarga
     *
     * @return string 
     */
    public function getDescripcionLarga()
    {
        return $this->descripcionLarga;
    }

    /**
     * Set icono
     *
     * @param string $icono
     * @return ifotos
     */
    public function setIcono($icono)
    {
        $this->icono = $icono;
    
        return $this;
    }

    /**
     * Get icono
     *
     * @return string 
     */
    public function getIcono()
    {
        return $this->icono;
    }

    /**
     * Set miniatura
     *
     * @param string $miniatura
     * @return ifotos
     */
    public function setMiniatura($miniatura)
    {
        $this->miniatura = $miniatura;
    
        return $this;
    }

    /**
     * Get miniatura
     *
     * @return string 
     */
    public function getMiniatura()
    {
        return $this->miniatura;
    }

    /**
     * Set foto
     *
     * @param string $foto
     * @return ifotos
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    
        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }


    /**
     * Set album
     *
     * @param \fm\mainBundle\Entity\ialbums $album
     * @return ifotos
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