<?php

namespace fm\erpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ordenesfabricacion
 */
class ordenesfabricacion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $numeroserie;

    /**
     * @var string
     */
    private $origen;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var \DateTime
     */
    private $fecha;


    public function __toString(){

        return $this->getNumeroserie();
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
     * Set numeroserie
     *
     * @param string $numeroserie
     * @return ordenesfabricacion
     */
    public function setNumeroserie($numeroserie)
    {
        $this->numeroserie = $numeroserie;
    
        return $this;
    }

    /**
     * Get numeroserie
     *
     * @return string 
     */
    public function getNumeroserie()
    {
        return $this->numeroserie;
    }


    /**
     * Set origen
     *
     * @param string $origen
     * @return ordenesfabricacion
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;
    
        return $this;
    }

    /**
     * Get origen
     *
     * @return string 
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return ordenesfabricacion
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return ordenesfabricacion
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
    
    /**
     * Add contenido
     *
     * @param \fm\erpBundle\Entity\referencias $contenido
     * @return ordenesfabricacion
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
     * @param \Doctrine\Common\Collections\Collection 
     */
    public function setContenido(\Doctrine\Common\Collections\Collection $contenido)
    {
        $this->contenido = $contenido;
    }



    /**
     * Set contenido
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContenido()
    {
        return $this->contenido;
    }
    /**
     * @var string
     */
    private $producto;


    /**
     * Set producto
     *
     * @param string $producto
     * @return ordenesfabricacion
     */
    public function setProducto($producto)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return string 
     */
    public function getProducto()
    {
        return $this->producto;
    }
    /**
     * @var \fm\erpBundle\Entity\envios
     */
    private $envio;


    /**
     * Set envio
     *
     * @param \fm\erpBundle\Entity\envios $envio
     * @return ordenesfabricacion
     */
    public function setEnvio(\fm\erpBundle\Entity\envios $envio = null)
    {
        $this->envio = $envio;
    
        return $this;
    }

    /**
     * Get envio
     *
     * @return \fm\erpBundle\Entity\envios 
     */
    public function getEnvio()
    {
        return $this->envio;
    }
    /**
     * @var \fm\erpBundle\Entity\envios
     */
    private $enviado;


    /**
     * Set enviado
     *
     * @param \fm\erpBundle\Entity\envios $enviado
     * @return ordenesfabricacion
     */
    public function setEnviado(\fm\erpBundle\Entity\envios $enviado = null)
    {
        $this->enviado = $enviado;
    
        return $this;
    }

    /**
     * Get enviado
     *
     * @return \fm\erpBundle\Entity\envios 
     */
    public function getEnviado()
    {
        return $this->enviado;
    }
    /**
     * @var \fm\erpBundle\Entity\envios
     */
    private $envio_id;


    /**
     * Set envio_id
     *
     * @param \fm\erpBundle\Entity\envios $envioId
     * @return ordenesfabricacion
     */
    public function setEnvioId(\fm\erpBundle\Entity\envios $envioId = null)
    {
        $this->envio_id = $envioId;
    
        return $this;
    }

    /**
     * Get envio_id
     *
     * @return \fm\erpBundle\Entity\envios 
     */
    public function getEnvioId()
    {
        return $this->envio_id;
    }
    /**
     * @var \fm\erpBundle\Entity\envios
     */
    private $mienvio;


    /**
     * Set mienvio
     *
     * @param \fm\erpBundle\Entity\envios $mienvio
     * @return ordenesfabricacion
     */
    public function setMienvio(\fm\erpBundle\Entity\envios $mienvio = null)
    {
        $this->mienvio = $mienvio;
    
        return $this;
    }

    /**
     * Get mienvio
     *
     * @return \fm\erpBundle\Entity\envios 
     */
    public function getMienvio()
    {
        return $this->mienvio;
    }
    /**
     * @var \fm\erpBundle\Entity\cajones
     */
    private $micajon;


    /**
     * Set micajon
     *
     * @param \fm\erpBundle\Entity\cajones $micajon
     * @return ordenesfabricacion
     */
    public function setMicajon(\fm\erpBundle\Entity\cajones $micajon = null)
    {
        $this->micajon = $micajon;
    
        return $this;
    }

    /**
     * Get micajon
     *
     * @return \fm\erpBundle\Entity\cajones 
     */
    public function getMicajon()
    {
        return $this->micajon;
    }
}
