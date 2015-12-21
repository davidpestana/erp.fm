<?php

namespace fm\erpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * conceptounico
 */
class conceptounico
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $concepto;


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
     * Set concepto
     *
     * @param string $concepto
     * @return conceptounico
     */
    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;

        return $this;
    }

    /**
     * Get concepto
     *
     * @return string 
     */
    public function getConcepto()
    {
        return $this->concepto;
    }
}
