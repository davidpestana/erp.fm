<?php

namespace fm\erpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * item
 */
class item
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var integer
     */
    private $cantidad;

    /**
     * @var integer
     */
    private $importe;

    /**
     * @var integer
     */
    private $descuento;



    public function __clone(){
        //ld($this);
        //if($this->id)
         //   $this->setId(null);
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return item
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
     * Set cantidad
     *
     * @param integer $cantidad
     * @return item
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
     * Set importe
     *
     * @param integer $importe
     * @return item
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;
    
        return $this;
    }

    /**
     * Get importe
     *
     * @return integer 
     */
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set descuento
     *
     * @param integer $descuento
     * @return item
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
     * @var \fm\erpBundle\Entity\factura
     */
    private $factura;


    /**
     * Set factura
     *
     * @param \fm\erpBundle\Entity\factura $factura
     * @return item
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
     * @var integer
     */
    private $producto_id;


    /**
     * Set producto_id
     *
     * @param integer $productoId
     * @return item
     */
    public function setProductoId($productoId)
    {
        $this->producto_id = $productoId;
    
        return $this;
    }

    /**
     * Get producto_id
     *
     * @return integer 
     */
    public function getProductoId()
    {
        return $this->producto_id;
    }
}