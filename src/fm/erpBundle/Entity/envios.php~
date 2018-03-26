<?php

namespace fm\erpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * envios
 */
class envios
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var \fm\erpBundle\Entity\clientes
     */
    private $cliente;

    public function __toString(){
        return $this->getId().$this->getObservaciones();

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
     * Set observaciones
     *
     * @param string $observaciones
     * @return envios
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
     * Set estado
     *
     * @param string $estado
     * @return envios
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set cliente
     *
     * @param \fm\erpBundle\Entity\clientes $cliente
     * @return envios
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
    private $misordenes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->misordenes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add misordenes
     *
     * @param \fm\erpBundle\Entity\ordenesfabricacion $misordenes
     * @return envios
     */
    public function addMisordenes(\fm\erpBundle\Entity\ordenesfabricacion $misordenes)
    {
        echo('pasa');

        $this->misordenes[] = $misordenes;
    
        return $this;
    }

    /**
     * Remove misordenes
     *
     * @param \fm\erpBundle\Entity\ordenesfabricacion $misordenes
     */
    public function removeMisordenes(\fm\erpBundle\Entity\ordenesfabricacion $misordenes)
    {
        $this->misordenes->removeElement($misordenes);
    }

    /**
     * Get misordenes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMisordenes()
    {
        return $this->misordenes;
    }
    /**
     * @var \DateTime
     */
    private $fecha;


    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return envios
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
     * @var string
     */
    private $observaciones_entrega;


    /**
     * Set observaciones_entrega
     *
     * @param string $observacionesEntrega
     * @return envios
     */
    public function setObservacionesEntrega($observacionesEntrega)
    {
        $this->observaciones_entrega = $observacionesEntrega;
    
        return $this;
    }

    /**
     * Get observaciones_entrega
     *
     * @return string 
     */
    public function getObservacionesEntrega()
    {
        return $this->observaciones_entrega;
    }

    /**
     * Add misordenes
     *
     * @param \fm\erpBundle\Entity\ordenesfabricacion $misordenes
     * @return envios
     */
    public function addMisordene(\fm\erpBundle\Entity\ordenesfabricacion $misordenes)
    {
        $this->misordenes[] = $misordenes;

        return $this;
    }

    /**
     * Remove misordenes
     *
     * @param \fm\erpBundle\Entity\ordenesfabricacion $misordenes
     */
    public function removeMisordene(\fm\erpBundle\Entity\ordenesfabricacion $misordenes)
    {
        $this->misordenes->removeElement($misordenes);
    }
    /**
     * @var \fm\erpBundle\Entity\factura
     */
    private $factura;


    /**
     * Set factura
     *
     * @param \fm\erpBundle\Entity\factura $factura
     * @return envios
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
}
