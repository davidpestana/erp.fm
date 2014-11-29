<?php

namespace fm\erpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * referencias
 */
class referencias
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
     * @var string
     */
    private $codfurgo;


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
     * @return referencias
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
     * Set codfurgo
     *
     * @param string $codfurgo
     * @return referencias
     */
    public function setCodfurgo($codfurgo)
    {
        $this->codfurgo = $codfurgo;
    
        return $this;
    }

    /**
     * Get codfurgo
     *
     * @return string 
     */
    public function getCodfurgo()
    {
        return $this->codfurgo;
    }

    public function __toString(){
        return $this->codfurgo." - ".$this->descripcion;

    }
}