<?php

namespace fm\erpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * proformas
 */
class proformas
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $codproforma;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var \fm\erpBundle\Entity\clientes
     */
    private $cliente;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $misproductos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->misproductos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set codproforma
     *
     * @param string $codproforma
     * @return proformas
     */
    public function setCodproforma($codproforma)
    {
        $this->codproforma = $codproforma;
    
        return $this;
    }

    /**
     * Get codproforma
     *
     * @return string 
     */
    public function getCodproforma()
    {
        return $this->codproforma;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return proformas
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return proformas
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    
        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set cliente
     *
     * @param \fm\erpBundle\Entity\clientes $cliente
     * @return proformas
     */
    public function setCliente(\fm\erpBundle\Entity\clientes $cliente = null)
    {
        $this->cliente = $cliente;
    
        return $this;
    }

    /**
     * Get cliente
     *
     * @return \fm\erpBundle\Entity\clientes 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Add misproductos
     *
     * @param \fm\erpBundle\Entity\productos $misproductos
     * @return proformas
     */
    public function addMisproducto(\fm\erpBundle\Entity\productos $misproductos)
    {
        $this->misproductos[] = $misproductos;
    
        return $this;
    }

    /**
     * Remove misproductos
     *
     * @param \fm\erpBundle\Entity\productos $misproductos
     */
    public function removeMisproducto(\fm\erpBundle\Entity\productos $misproductos)
    {
        $this->misproductos->removeElement($misproductos);
    }

    /**
     * Get misproductos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMisproductos()
    {
        return $this->misproductos;
    }
}