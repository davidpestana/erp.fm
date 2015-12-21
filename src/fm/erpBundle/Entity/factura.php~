<?php

namespace fm\erpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * factura
 */
class factura
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $codfactura;

    /**
     * @var string
     */
    private $fecha;

    /**
     * @var integer
     */
    private $total;

    /**
     * @var integer
     */
    private $iva;

    /**
     * @var integer
     */
    private $descuento;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var string
     */
    private $tipo;


    public function __clone(){
        if($this->id){
                $this->setEstado(1);
                $this->setCodFactura(null);
                $this->setFecha(new \DateTime());
                foreach($this->misitems as $item) $this->addMisitem(clone $item);
        }
    }


    public function getTipo(){
    	return $this->getSerie()->getDescripcion();
    	/*
        switch($this->getSerie()->getSerie()){
            case "FR": $tipo = "factura rectificativa"; break;
            case "FV": $tipo = "factura"; break;
            case "AB": $tipo = "factura de abono"; break;
            case "FM": $tipo = "factura proforma"; break;
            
        }
        return $tipo;*/
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
     * Set codfactura
     *
     * @param string $codfactura
     * @return factura
     */
    public function setCodfactura($codfactura)
    {
        $this->codfactura = $codfactura;
    
        return $this;
    }

    /**
     * Get codfactura
     *
     * @return string 
     */
    public function getCodfactura()
    {
        return $this->codfactura;
    }

    /**
     * Set fecha
     *
     * @param string $fecha
     * @return factura
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return string 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

  
    /**
     * Set descuento
     *
     * @param integer $descuento
     * @return factura
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
     * Set estado
     *
     * @param integer $estado
     * @return factura
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }
    /**
     * @var \fm\erpBundle\Entity\clientes
     */
    private $cliente;


    /**
     * Set cliente
     *
     * @param \fm\erpBundle\Entity\clientes $cliente
     * @return factura
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $misitems;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->misitems = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString(){
        return $this->getCodfactura();
    }


    /**
     * Set misitems
     *
     */
    public function setMisitem(\Doctrine\Common\Collections\Collection $misitems)
    {
        $this->misitems = $misitems;
        foreach ($misitems as $item) {
            $item->setUser($this);
        }
    }



    /**
     * Add misitems
     *
     * @param \fm\erpBundle\Entity\item $misitems
     * @return factura
     */
    public function addMisitem(\fm\erpBundle\Entity\item $misitems)
    {
        $misitems->setFactura($this);
        $this->misitems[] = $misitems;
    
        return $this;
    }

    /**
     * Remove misitems
     *
     * @param \fm\erpBundle\Entity\item $misitems
     */
    public function removeMisitem(\fm\erpBundle\Entity\item $item)
    {
        $this->misitems->removeElement($item);
    }

    /**
     * Get misitems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMisitems()
    {
        return $this->misitems;
    }
    /**
     * @var string
     */
    private $observaciones;


    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return factura
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
     * @var integer
     */
    private $base;


    /**
     * Set base
     *
     * @param integer $base
     * @return factura
     */
    public function setBase()
    {
        //$this->base = $base;
        $items = $this->getMisitems();
        $base = 0;
        foreach($items as $item){
            $base = $base + ($item->getCantidad() * ($item->getImporte() - $item->getDescuento()));
        } 
        $this->base = $base;
        return $this;
    }

    /**
     * Get base
     *
     * @return integer 
     */
    public function getBase()
    {
        return $this->base;
    }
    /**
     * @var string
     */
    private $serie;


    /**
     * Set serie
     *
     * @param string $serie
     * @return factura
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;
    
        return $this;
    }

    /**
     * Get serie
     *
     * @return string 
     */
    public function getSerie()
    {
        return $this->serie;
    }
    /**
     * @var \DateTime
     */
    private $fechapagado;


    /**
     * Set fechapagado
     *
     * @param \DateTime $fechapagado
     * @return factura
     */
    public function setFechapagado($fechapagado)
    {
        $this->fechapagado = $fechapagado;
    
        return $this;
    }

    /**
     * Get fechapagado
     *
     * @return \DateTime 
     */
    public function getFechapagado()
    {
        return $this->fechapagado;
    }
    /**
     * @var \fm\erpBundle\Entity\series
     */
    private $miserie;


    /**
     * Set miserie
     *
     * @param \fm\erpBundle\Entity\series $miserie
     * @return factura
     */
    public function setMiserie(\fm\erpBundle\Entity\series $miserie)
    {
        $this->miserie = $miserie;
    
        return $this;
    }

    /**
     * Get miserie
     *
     * @return \fm\erpBundle\Entity\series 
     */
    public function getMiserie()
    {
        return $this->miserie;
    }

    /**
     * Set iva
     *
     * @param integer $iva
     * @return factura
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
    
        return $this;
    }

    /**
     * Get iva
     *
     * @return integer 
     */
    public function getIva()
    {
        return $this->iva;
    }
    /**
     * @var \fm\erpBundle\Entity\Sociedades
     */
    private $sociedad;


    /**
     * Set sociedad
     *
     * @param \fm\erpBundle\Entity\Sociedades $sociedad
     * @return factura
     */
    public function setSociedad(\fm\erpBundle\Entity\Sociedades $sociedad)
    {
        $this->sociedad = $sociedad;
    
        return $this;
    }

    /**
     * Get sociedad
     *
     * @return \fm\erpBundle\Entity\Sociedades 
     */
    public function getSociedad()
    {
        return $this->sociedad;
    }
}
