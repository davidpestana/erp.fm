<?php

namespace fm\erpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sociedades
 */
class Sociedades
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $razonSocial;

    /**
     * @var string
     */
    private $nif;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $cp;

    /**
     * @var string
     */
    private $localidad;

    /**
     * @var string
     */
    private $provincia;




    function __toString(){

        return $this->getRazonSocial();
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
     * Set razonSocial
     *
     * @param string $razonSocial
     * @return Sociedades
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;
    
        return $this;
    }

    /**
     * Get razonSocial
     *
     * @return string 
     */
    public function getRazonSocial()
    {
        return $this->razonSocial;
    }

    /**
     * Set nif
     *
     * @param string $nif
     * @return Sociedades
     */
    public function setNif($nif)
    {
        $this->nif = $nif;
    
        return $this;
    }

    /**
     * Get nif
     *
     * @return string 
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Sociedades
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
     * Set cp
     *
     * @param string $cp
     * @return Sociedades
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
     * Set localidad
     *
     * @param string $localidad
     * @return Sociedades
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
     * Set provincia
     *
     * @param string $provincia
     * @return Sociedades
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
     * @var string
     */

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $facturas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->facturas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add facturas
     *
     * @param \fm\erpBundle\Entity\factura $facturas
     * @return Sociedades
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
    /**
     * @var string
     */
    private $entidad;

    /**
     * @var string
     */
    private $iban;

    /**
     * @var string
     */
    private $codigoCuenta;

    /**
     * @var string
     */
    private $observaciones;


    /**
     * Set entidad
     *
     * @param string $entidad
     * @return Sociedades
     */
    public function setEntidad($entidad)
    {
        $this->entidad = $entidad;
    
        return $this;
    }

    /**
     * Get entidad
     *
     * @return string 
     */
    public function getEntidad()
    {
        return $this->entidad;
    }

    /**
     * Set iban
     *
     * @param string $iban
     * @return Sociedades
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
    
        return $this;
    }

    /**
     * Get iban
     *
     * @return string 
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * Set codigoCuenta
     *
     * @param string $codigoCuenta
     * @return Sociedades
     */
    public function setCodigoCuenta($codigoCuenta)
    {
        $this->codigoCuenta = $codigoCuenta;
    
        return $this;
    }

    /**
     * Get codigoCuenta
     *
     * @return string 
     */
    public function getCodigoCuenta()
    {
        return $this->codigoCuenta;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Sociedades
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $direcciones;


    /**
     * Add direcciones
     *
     * @param \fm\erpBundle\Entity\direcciones $direcciones
     * @return Sociedades
     */
    /*public function addDirecciones(\fm\erpBundle\Entity\direcciones $direcciones)
    {
        $this->direcciones[] = $direcciones;

        return $this;
    }*/

    /**
     * Set direcciones
     *
     * @param \fm\erpBundle\Entity\direcciones $direcciones
     * @return sociedad
     */
    public function setDirecciones(\fm\erpBundle\Entity\direcciones $direcciones)
    {
        $this->direcciones = $direcciones;

        return $this;
    }

    /**
     * Get direcciones
     *
     * @return \fm\erpBundle\Entity\direcciones 
     */
    public function getDirecciones()
    {
        return $this->direcciones;
    }

    /**
     * Add direcciones
     *
     * @param \fm\erpBundle\Entity\direcciones $direcciones
     * @return Sociedades
     */
    public function addDireccione(\fm\erpBundle\Entity\direcciones $direcciones)
    {
        $this->direcciones[] = $direcciones;

        return $this;
    }

    /**
     * Remove direcciones
     *
     * @param \fm\erpBundle\Entity\direcciones $direcciones
     */
    public function removeDireccione(\fm\erpBundle\Entity\direcciones $direcciones)
    {
        $this->direcciones->removeElement($direcciones);
    }
}
