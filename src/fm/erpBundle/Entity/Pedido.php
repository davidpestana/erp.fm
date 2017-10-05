<?php

namespace fm\erpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 */
class Pedido
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $fechaEntrega;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     */
    private $fechaEnvio;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $misFacturas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->misFacturas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fechaEntrega
     *
     * @param \DateTime $fechaEntrega
     * @return Pedido
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    /**
     * Get fechaEntrega
     *
     * @return \DateTime 
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Pedido
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaEnvio
     *
     * @param \DateTime $fechaEnvio
     * @return Pedido
     */
    public function setFechaEnvio($fechaEnvio)
    {
        $this->fechaEnvio = $fechaEnvio;

        return $this;
    }

    /**
     * Get fechaEnvio
     *
     * @return \DateTime 
     */
    public function getFechaEnvio()
    {
        return $this->fechaEnvio;
    }

    /**
     * Add misFacturas
     *
     * @param \fm\erpBundle\Entity\factura $misFacturas
     * @return Pedido
     */
    public function addMisFactura(\fm\erpBundle\Entity\factura $misFacturas)
    {
        $this->misFacturas[] = $misFacturas;

        return $this;
    }


    /**
     * set misFacturas
     *
     * @param \fm\erpBundle\Entity\factura $misFacturas
     * @return Pedido
     */
    public function setMisFacturas($misFacturas)
    {
        
       $this->misFacturas[] = $misFacturas;

        return $this;
    }

    /**
     * Remove misFacturas
     *
     * @param \fm\erpBundle\Entity\factura $misFacturas
     */
    public function removeMisFactura(\fm\erpBundle\Entity\factura $misFacturas)
    {
        $this->misFacturas->removeElement($misFacturas);
    }

    /**
     * Get misFacturas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMisFacturas()
    {
        return $this->misFacturas;
    }
}
