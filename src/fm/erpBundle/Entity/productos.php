<?php

namespace fm\erpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * productos
 */
class productos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $concepto;

    /**
     * @var integer
     */
    private $precio;

    /**
     * @var integer
     */
    private $descuento;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $contenido;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contenido = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString(){

        return $this->concepto;
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
     * Set concepto
     *
     * @param string $concepto
     * @return productos
     */
    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;
    
        return $this;
    }

    /**
     * Get concepto
     *
     * @return string 
     */
    public function getConcepto()
    {
        return $this->concepto;
    }

    /**
     * Set precio
     *
     * @param integer $precio
     * @return productos
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return integer 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set descuento
     *
     * @param integer $descuento
     * @return productos
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    
        return $this;
    }

    /**
     * Get descuento
     *
     * @return integer 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return productos
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Add contenido
     *
     * @param \fm\erpBundle\Entity\referencias $contenido
     * @return productos
     */
    public function addContenido(\fm\erpBundle\Entity\referencias $contenido)
    {
        $this->contenido[] = $contenido;
    
        return $this;
    }

    /**
     * Remove contenido
     *
     * @param \fm\erpBundle\Entity\referencias $contenido
     */
    public function removeContenido(\fm\erpBundle\Entity\referencias $contenido)
    {
        $this->contenido->removeElement($contenido);
    }

    /**
     * Get contenido
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContenido()
    {
        return $this->contenido;
    }
}