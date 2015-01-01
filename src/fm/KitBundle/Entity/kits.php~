<?php

namespace fm\KitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * kits
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="fm\KitBundle\Entity\kitsRepository")
 */
class kits
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */

    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var json_array
     *
     * @ORM\Column(name="galeria", type="json_array")
     */
    private $galeria;

    /**
     * @var json_array
     *
     * @ORM\Column(name="features", type="json_array")
     */
    private $features;

    /**
     * @var json_array
     *
     * @ORM\Column(name="contenido", type="json_array")
     */
    private $contenido;


    /**
     * @var json_array
     *
     * @ORM\Column(name="opciones", type="json_array")
     */
    private $opciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="precio", type="integer")
     */
    private $precio;

    /**
     * @var integer
     *
     * @ORM\Column(name="descuento", type="integer")
     */
    private $descuento;

    /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=255)
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=255)
     */
    private $modelo;

    /**
     * @var string
     *
     * @ORM\Column(name="marcaslug", type="string", length=255)
     */
    private $marcaslug;

    /**
     * @var string
     *
     * @ORM\Column(name="modeloslug", type="string", length=255)
     */
    private $modeloslug;

     /**

     * @ORM\ManyToOne(targetEntity="vehiculos")
     * @ORM\JoinColumn(name="vehiculo_id", referencedColumnName="id", nullable=true)
     * @var fm\KitBundle\Entity\vehiculos
     */
    protected $vehiculo_id;


    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255)
     */
    private $estado;


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
     * Set nombre
     *
     * @param string $nombre
     * @return kits
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return kits
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
     * Set galeria
     *
     * @param json_array $galeria
     * @return kits
     */
    public function setGaleria($galeria)
    {
        $this->galeria = $galeria;
    
        return $this;
    }

    /**
     * Get galeria
     *
     * @return json_array 
     */
    public function getGaleria()
    {
        return $this->galeria;
    }

    /**
     * Set features
     *
     * @param json_array $features
     * @return kits
     */
    public function setFeatures($features)
    {
        $this->features = $features;
    
        return $this;
    }

    /**
     * Get features
     *
     * @return json_array 
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * Set contenido
     *
     * @param json_array $contenido
     * @return kits
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;
    
        return $this;
    }

    /**
     * Get contenido
     *
     * @return json_array 
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set precio
     *
     * @param integer $precio
     * @return kits
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return integer 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set descuento
     *
     * @param integer $descuento
     * @return kits
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
     * Set marca
     *
     * @param string $marca
     * @return kits
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    
        return $this;
    }

    /**
     * Get marca
     *
     * @return string 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set modelo
     *
     * @param string $modelo
     * @return kits
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    
        return $this;
    }

    /**
     * Get modelo
     *
     * @return string 
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set marcaslug
     *
     * @param string $marcaslug
     * @return kits
     */
    public function setMarcaslug($marcaslug)
    {
        $this->marcaslug = $marcaslug;
    
        return $this;
    }

    /**
     * Get marcaslug
     *
     * @return string 
     */
    public function getMarcaslug()
    {
        return $this->marcaslug;
    }

    /**
     * Set modeloslug
     *
     * @param string $modeloslug
     * @return kits
     */
    public function setModeloslug($modeloslug)
    {
        $this->modeloslug = $modeloslug;
    
        return $this;
    }

    /**
     * Get modeloslug
     *
     * @return string 
     */
    public function getModeloslug()
    {
        return $this->modeloslug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return kits
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set opciones
     *
     * @param array $opciones
     * @return kits
     */
    public function setOpciones($opciones)
    {
        $this->opciones = $opciones;
    
        return $this;
    }

    /**
     * Get opciones
     *
     * @return array 
     */
    public function getOpciones()
    {
        return $this->opciones;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return kits
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
     * Constructor
     */
    public function __construct()
    {
        $this->vehiculo = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add vehiculo
     *
     * @param \fm\KitBundle\Entity\vehiculos $vehiculo
     * @return kits
     */
    public function addVehiculo(\fm\KitBundle\Entity\vehiculos $vehiculo)
    {
        $this->vehiculo[] = $vehiculo;
    
        return $this;
    }

    /**
     * Remove vehiculo
     *
     * @param \fm\KitBundle\Entity\vehiculos $vehiculo
     */
    public function removeVehiculo(\fm\KitBundle\Entity\vehiculos $vehiculo)
    {
        $this->vehiculo->removeElement($vehiculo);
    }

    /**
     * Get vehiculo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVehiculo()
    {
        return $this->vehiculo;
    }

    /**
     * Set vehiculo_id
     *
     * @param \fm\KitBundle\Entity\vehiculo $vehiculoId
     * @return kits
     */
    public function setVehiculoId(\fm\KitBundle\Entity\vehiculo $vehiculoId = null)
    {
        $this->vehiculo_id = $vehiculoId;
    
        return $this;
    }

    /**
     * Get vehiculo_id
     *
     * @return \fm\KitBundle\Entity\vehiculo 
     */
    public function getVehiculoId()
    {
        return $this->vehiculo_id;
    }
}