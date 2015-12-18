<?php

namespace fm\erpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * series
 */
class series
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $serie;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var integer
     */
    private $operador;


    public function __toString(){
        return "{$this->descripcion} ({$this->serie})";

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
     * Set serie
     *
     * @param string $serie
     * @return series
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return series
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
     * Set operador
     *
     * @param integer $operador
     * @return series
     */
    public function setOperador($operador)
    {
        $this->operador = $operador;
    
        return $this;
    }

    /**
     * Get operador
     *
     * @return integer 
     */
    public function getOperador()
    {
        return $this->operador;
    }
}
