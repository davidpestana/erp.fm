<?php

namespace fm\erpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * productoreferencia
 */
class productoreferencia
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $cantidad;

    /**
     * @var \fm\erpBundle\Entity\referencias
     */
    private $referencia;

    /**
     * @var \fm\erpBundle\Entity\productos
     */
    private $producto;


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
     * Set cantidad
     *
     * @param integer $cantidad
     * @return productoreferencia
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
     * Set referencia
     *
     * @param \fm\erpBundle\Entity\referencias $referencia
     * @return productoreferencia
     */
    public function setReferencia(\fm\erpBundle\Entity\referencias $referencia = null)
    {
        $this->referencia = $referencia;
    
        return $this;
    }

    /**
     * Get referencia
     *
     * @return \fm\erpBundle\Entity\referencias 
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * Set producto
     *
     * @param \fm\erpBundle\Entity\productos $producto
     * @return productoreferencia
     */
    public function setProducto(\fm\erpBundle\Entity\productos $producto = null)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return \fm\erpBundle\Entity\productos 
     */
    public function getProducto()
    {
        return $this->producto;
    }
}