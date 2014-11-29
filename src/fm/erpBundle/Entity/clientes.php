<?php

namespace fm\erpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * clientes
 */
class clientes
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $provincia;

    /**
     * @var string
     */
    private $cp;

    /**
     * @var string
     */
    private $dniCif;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var string
     */
    private $furgo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $proformas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->proformas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return clientes
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return clientes
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return clientes
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     * @return clientes
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    
        return $this;
    }

    /**
     * Get provincia
     *
     * @return string 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return clientes
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    
        return $this;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set dniCif
     *
     * @param string $dniCif
     * @return clientes
     */
    public function setDniCif($dniCif)
    {
        $this->dniCif = $dniCif;
    
        return $this;
    }

    /**
     * Get dniCif
     *
     * @return string 
     */
    public function getDniCif()
    {
        return $this->dniCif;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return clientes
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
     * Set furgo
     *
     * @param string $furgo
     * @return clientes
     */
    public function setFurgo($furgo)
    {
        $this->furgo = $furgo;
    
        return $this;
    }

    /**
     * Get furgo
     *
     * @return string 
     */
    public function getFurgo()
    {
        return $this->furgo;
    }

    /**
     * Add proformas
     *
     * @param \fm\erpBundle\Entity\proformas $proformas
     * @return clientes
     */
    public function addProforma(\fm\erpBundle\Entity\proformas $proformas)
    {
        $this->proformas[] = $proformas;
    
        return $this;
    }

    /**
     * Remove proformas
     *
     * @param \fm\erpBundle\Entity\proformas $proformas
     */
    public function removeProforma(\fm\erpBundle\Entity\proformas $proformas)
    {
        $this->proformas->removeElement($proformas);
    }

    /**
     * Get proformas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProformas()
    {
        return $this->proformas;
    }

    function __toString(){

        return $this->getName();
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $envios;


    /**
     * Add envios
     *
     * @param \fm\erpBundle\Entity\envios $envios
     * @return clientes
     */
    public function addEnvio(\fm\erpBundle\Entity\envios $envios)
    {
        $this->envios[] = $envios;
    
        return $this;
    }

    /**
     * Remove envios
     *
     * @param \fm\erpBundle\Entity\envios $envios
     */
    public function removeEnvio(\fm\erpBundle\Entity\envios $envios)
    {
        $this->envios->removeElement($envios);
    }

    /**
     * Get envios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEnvios()
    {
        return $this->envios;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $misenvios;


    /**
     * Add misenvios
     *
     * @param \fm\erpBundle\Entity\envios $misenvios
     * @return clientes
     */
    public function addMisenvio(\fm\erpBundle\Entity\envios $misenvios)
    {
        $this->misenvios[] = $misenvios;
    
        return $this;
    }

    /**
     * Remove misenvios
     *
     * @param \fm\erpBundle\Entity\envios $misenvios
     */
    public function removeMisenvio(\fm\erpBundle\Entity\envios $misenvios)
    {
        $this->misenvios->removeElement($misenvios);
    }

    /**
     * Get misenvios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMisenvios()
    {
        return $this->misenvios;
    }
    /**
     * @var string
     */
    private $telefono;

    /**
     * @var string
     */
    private $localidad;


    /**
     * Set telefono
     *
     * @param string $telefono
     * @return clientes
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set localidad
     *
     * @param string $localidad
     * @return clientes
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    
        return $this;
    }

    /**
     * Get localidad
     *
     * @return string 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $facturas;


    /**
     * Add facturas
     *
     * @param \fm\erpBundle\Entity\factura $facturas
     * @return clientes
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