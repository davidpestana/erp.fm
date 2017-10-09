<?php

namespace fm\erpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PedidoItem
 */
class PedidoItem
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $fechaInclusion;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ordenes;

    /**
     * @var \fm\erpBundle\Entity\Pedido
     */
    private $pedido;

    /**
     * Constructor
     */
    public function __construct()
    {
        //$this->setFechaInclusion =  new \DateTime();
        $this->ordenes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    public function doPrePersist()
    {
        ldd('hola');
        $this->setFechaInclusion = new \DateTimeNow();
    }

    /**
     * @return string     
     */
     public function __toString()
     {
         return $this->getDescripcion();
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

    public function flushId()
    {
        $this->id = null;
    }
    /**
     * Set fechaInclusion
     *
     * @param \DateTime $fechaInclusion
     * @return PedidoItem
     */
    public function setFechaInclusion($fechaInclusion)
    {
        $this->fechaInclusion = $fechaInclusion;

        return $this;
    }

    /**
     * Get fechaInclusion
     *
     * @return \DateTime 
     */
    public function getFechaInclusion()
    {
        return $this->fechaInclusion;
    }


    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return PedidoItem
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
     * Add ordenes
     *
     * @param \fm\erpBundle\Entity\ordenesfabricacion $ordenes
     * @return PedidoItem
     */
    public function addOrdene(\fm\erpBundle\Entity\ordenesfabricacion $ordenes)
    {
        $this->ordenes[] = $ordenes;

        return $this;
    }

    /**
     * Remove ordenes
     *
     * @param \fm\erpBundle\Entity\ordenesfabricacion $ordenes
     */
    public function removeOrdene(\fm\erpBundle\Entity\ordenesfabricacion $ordenes)
    {
        $this->ordenes->removeElement($ordenes);
    }

    /**
     * Get ordenes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrdenes()
    {
        return $this->ordenes;
    }

    /**
     * Set pedido
     *
     * @param \fm\erpBundle\Entity\Pedido $pedido
     * @return PedidoItem
     */
    public function setPedido(\fm\erpBundle\Entity\Pedido $pedido = null)
    {
        $this->pedido = $pedido;

        return $this;
    }

    /**
     * Get pedido
     *
     * @return \fm\erpBundle\Entity\Pedido 
     */
    public function getPedido()
    {
        return $this->pedido;
    }
    /**
     * @var string
     */
    private $proveedor;


    /**
     * Set proveedor
     *
     * @param string $proveedor
     * @return PedidoItem
     */
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return string 
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }
    /**
     * @var integer
     */
    private $cantidad;


    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return PedidoItem
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }
    /**
     * @var \fm\erpBundle\Entity\factura
     */
    private $factura;


    /**
     * Set factura
     *
     * @param \fm\erpBundle\Entity\factura $factura
     * @return PedidoItem
     */
    public function setFactura(\fm\erpBundle\Entity\factura $factura = null)
    {
        $this->factura = $factura;

        return $this;
    }

    /**
     * Get factura
     *
     * @return \fm\erpBundle\Entity\factura 
     */
    public function getFactura()
    {
        return $this->factura;
    }
    /**
     * @var string
     */
    private $descripcion;


    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return PedidoItem
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
}
