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
    private $facturas;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
     private $items;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fechaCreacion = new \DateTime();
        $this->misFacturas = new \Doctrine\Common\Collections\ArrayCollection();
    }



    public function doPrePersist()
    {
        ldd('hola');
       // $this->setFechaInclusion = new \DateTimeNow();
    }

    /**
     * @return string     
     */
     public function __toString()
     {
         return "Pedido ".$this->getId()." (".$this->getFechaEntrega()->format('d-m-Y').")";
     }

     public function tramitar(){
         $this->fechaEnvio = new \DateTime();
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
     * Add items
     *
     * @param \fm\erpBundle\Entity\PedidoItem $items
     * @return Pedido
     */
    public function addItem(\fm\erpBundle\Entity\PedidoItem $items)
    {
        $items->setPedido($this);
        if($items->getFechaInclusion() == null) 
            $items->setFechaInclusion(new \DateTime());
        if($items->getCantidad() == null) 
            $items->setCantidad(1);
            
        $this->items[] = $items;
        return $this;
    }

    /**
     * Remove items
     *
     * @param \fm\erpBundle\Entity\PedidoItem $items
     */
    public function removeItem(\fm\erpBundle\Entity\PedidoItem $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }


    /**
     * Add facturas
     *
     * @param \fm\erpBundle\Entity\factura $facturas
     * @return Pedido
     */
    public function addFactura(\fm\erpBundle\Entity\factura $facturas)
    {
        $this->facturas[] = $facturas;

        return $this;
    }

    /**
     * Remove facturas
     *
     * @param \fm\erpBundle\Entity\factura $facturas
     */
    public function removeFactura(\fm\erpBundle\Entity\factura $facturas)
    {
        $this->facturas->removeElement($facturas);
    }

    /**
     * Get facturas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFacturas()
    {
        return $this->facturas;
    }
}
