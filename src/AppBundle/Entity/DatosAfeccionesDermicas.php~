<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosAfeccionesDermicas
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\DatosADRepository")
 */
class DatosAfeccionesDermicas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idDatosAfeccionesDermicas", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idDatosAfeccionesDermicas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="Estado", type="string", length=60)
     */
    private $estado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Cicatriz", type="boolean",nullable=true)
     */
    private $cicatriz;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Tumoracion", type="boolean",nullable=true)
     */
    private $tumoracion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IPK", type="boolean",nullable=true)
     */
    private $iPK;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Psoriasis", type="boolean",nullable=true)
     */
    private $psoriasis;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Otros", type="boolean",nullable=true)
     */
    private $otros;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Papiloma", type="boolean",nullable=true)
     */
    private $papiloma;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Ampolla", type="boolean",nullable=true)
     */
    private $ampolla;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Hiperqueratosis", type="boolean",nullable=true)
     */
    private $hiperqueratosis;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Vesicula", type="boolean",nullable=true)
     */
    private $vesicula;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Heloma", type="boolean",nullable=true)
     */
    private $heloma;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Erupcion", type="boolean",nullable=true)
     */
    private $erupcion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Ulcera", type="boolean",nullable=true)
     */
    private $ulcera;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Nevus", type="boolean",nullable=true)
     */
    private $nevus;

    /**
     * @var boolean
     *
     * @ORM\Column(name="HelomaVascular", type="boolean",nullable=true)
     */
    private $helomaVascular;

    /**
     * @ORM\ManyToOne(targetEntity="Anamnesis")
     * @ORM\JoinColumn(name="Anamnesis_idAnamnesis", referencedColumnName="idAnamnesis",nullable=false)
     **/
    private $anamnesis;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getIdDatosAfeccionesDermicas()
    {
        return $this->idDatosAfeccionesDermicas;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return DatosAfeccionesDermicas
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
     * Set estado
     *
     * @param string $estado
     * @return DatosAfeccionesDermicas
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
     * Set cicatriz
     *
     * @param boolean $cicatriz
     * @return DatosAfeccionesDermicas
     */
    public function setCicatriz($cicatriz)
    {
        $this->cicatriz = $cicatriz;

        return $this;
    }

    /**
     * Get cicatriz
     *
     * @return boolean 
     */
    public function getCicatriz()
    {
        return $this->cicatriz;
    }

    /**
     * Set tumoracion
     *
     * @param boolean $tumoracion
     * @return DatosAfeccionesDermicas
     */
    public function setTumoracion($tumoracion)
    {
        $this->tumoracion = $tumoracion;

        return $this;
    }

    /**
     * Get tumoracion
     *
     * @return boolean 
     */
    public function getTumoracion()
    {
        return $this->tumoracion;
    }

    /**
     * Set iPK
     *
     * @param boolean $iPK
     * @return DatosAfeccionesDermicas
     */
    public function setIPK($iPK)
    {
        $this->iPK = $iPK;

        return $this;
    }

    /**
     * Get iPK
     *
     * @return boolean 
     */
    public function getIPK()
    {
        return $this->iPK;
    }

    /**
     * Set psoriasis
     *
     * @param boolean $psoriasis
     * @return DatosAfeccionesDermicas
     */
    public function setPsoriasis($psoriasis)
    {
        $this->psoriasis = $psoriasis;

        return $this;
    }

    /**
     * Get psoriasis
     *
     * @return boolean 
     */
    public function getPsoriasis()
    {
        return $this->psoriasis;
    }

    /**
     * Set otros
     *
     * @param boolean $otros
     * @return DatosAfeccionesDermicas
     */
    public function setOtros($otros)
    {
        $this->otros = $otros;

        return $this;
    }

    /**
     * Get otros
     *
     * @return boolean 
     */
    public function getOtros()
    {
        return $this->otros;
    }

    /**
     * Set papiloma
     *
     * @param boolean $papiloma
     * @return DatosAfeccionesDermicas
     */
    public function setPapiloma($papiloma)
    {
        $this->papiloma = $papiloma;

        return $this;
    }

    /**
     * Get papiloma
     *
     * @return boolean 
     */
    public function getPapiloma()
    {
        return $this->papiloma;
    }

    /**
     * Set ampolla
     *
     * @param boolean $ampolla
     * @return DatosAfeccionesDermicas
     */
    public function setAmpolla($ampolla)
    {
        $this->ampolla = $ampolla;

        return $this;
    }

    /**
     * Get ampolla
     *
     * @return boolean 
     */
    public function getAmpolla()
    {
        return $this->ampolla;
    }

    /**
     * Set hiperqueratosis
     *
     * @param boolean $hiperqueratosis
     * @return DatosAfeccionesDermicas
     */
    public function setHiperqueratosis($hiperqueratosis)
    {
        $this->hiperqueratosis = $hiperqueratosis;

        return $this;
    }

    /**
     * Get hiperqueratosis
     *
     * @return boolean 
     */
    public function getHiperqueratosis()
    {
        return $this->hiperqueratosis;
    }

    /**
     * Set vesicula
     *
     * @param boolean $vesicula
     * @return DatosAfeccionesDermicas
     */
    public function setVesicula($vesicula)
    {
        $this->vesicula = $vesicula;

        return $this;
    }

    /**
     * Get vesicula
     *
     * @return boolean 
     */
    public function getVesicula()
    {
        return $this->vesicula;
    }

    /**
     * Set heloma
     *
     * @param boolean $heloma
     * @return DatosAfeccionesDermicas
     */
    public function setHeloma($heloma)
    {
        $this->heloma = $heloma;

        return $this;
    }

    /**
     * Get heloma
     *
     * @return boolean 
     */
    public function getHeloma()
    {
        return $this->heloma;
    }

    /**
     * Set erupcion
     *
     * @param boolean $erupcion
     * @return DatosAfeccionesDermicas
     */
    public function setErupcion($erupcion)
    {
        $this->erupcion = $erupcion;

        return $this;
    }

    /**
     * Get erupcion
     *
     * @return boolean 
     */
    public function getErupcion()
    {
        return $this->erupcion;
    }

    /**
     * Set ulcera
     *
     * @param boolean $ulcera
     * @return DatosAfeccionesDermicas
     */
    public function setUlcera($ulcera)
    {
        $this->ulcera = $ulcera;

        return $this;
    }

    /**
     * Get ulcera
     *
     * @return boolean 
     */
    public function getUlcera()
    {
        return $this->ulcera;
    }

    /**
     * Set nevus
     *
     * @param boolean $nevus
     * @return DatosAfeccionesDermicas
     */
    public function setNevus($nevus)
    {
        $this->nevus = $nevus;

        return $this;
    }

    /**
     * Get nevus
     *
     * @return boolean 
     */
    public function getNevus()
    {
        return $this->nevus;
    }

    /**
     * Set helomaVascular
     *
     * @param boolean $helomaVascular
     * @return DatosAfeccionesDermicas
     */
    public function setHelomaVascular($helomaVascular)
    {
        $this->helomaVascular = $helomaVascular;

        return $this;
    }

    /**
     * Get helomaVascular
     *
     * @return boolean 
     */
    public function getHelomaVascular()
    {
        return $this->helomaVascular;
    }

    /**
     * Set anamnesis
     *
     * @param \AppBundle\Entity\Anamnesis $anamnesis
     * @return DatosAfeccionesDermicas
     */
    public function setAnamnesis(\AppBundle\Entity\Anamnesis $anamnesis)
    {
        $this->anamnesis = $anamnesis;

        return $this;
    }

    /**
     * Get anamnesis
     *
     * @return \AppBundle\Entity\Anamnesis 
     */
    public function getAnamnesis()
    {
        return $this->anamnesis;
    }
}
