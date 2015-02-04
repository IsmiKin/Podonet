<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosAnamnesis
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\DatosAnamnesisRepository")
 */
class DatosAnamnesis
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idAnamnesis", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idAnamnesis;

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
     * @ORM\Column(name="Dolor", type="boolean", nullable=true)
     */
    private $dolor;

    /**
     * @var binary
     *
     * @ORM\Column(name="ImagenDolor", type="binary", nullable=true)
     */
    private $imagenDolor;

    /**
     * @var integer
     *
     * @ORM\Column(name="Intensidad", type="integer", nullable=true)
     */
    private $intensidad;

    /**
     * @var string
     *
     * @ORM\Column(name="TipoDolor", type="string", length=60, nullable=true)
     */
    private $tipoDolor;

    /**
     * @var string
     *
     * @ORM\Column(name="FormulaMetatarsal", type="string", length=60, nullable=true)
     */
    private $formulaMetatarsal;

    /**
     * @var string
     *
     * @ORM\Column(name="FormulaDigital", type="string", length=60, nullable=true)
     */
    private $formulaDigital;

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
    public function getIdAnamnesis()
    {
        return $this->idAnamnesis;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return DatosAnamnesis
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
     * @return DatosAnamnesis
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
     * Set dolor
     *
     * @param boolean $dolor
     * @return DatosAnamnesis
     */
    public function setDolor($dolor)
    {
        $this->dolor = $dolor;

        return $this;
    }

    /**
     * Get dolor
     *
     * @return boolean 
     */
    public function getDolor()
    {
        return $this->dolor;
    }

    /**
     * Set imagenDolor
     *
     * @param binary $imagenDolor
     * @return DatosAnamnesis
     */
    public function setImagenDolor($imagenDolor)
    {
        $this->imagenDolor = $imagenDolor;

        return $this;
    }

    /**
     * Get imagenDolor
     *
     * @return binary 
     */
    public function getImagenDolor()
    {
        return $this->imagenDolor;
    }

    /**
     * Set intensidad
     *
     * @param integer $intensidad
     * @return DatosAnamnesis
     */
    public function setIntensidad($intensidad)
    {
        $this->intensidad = $intensidad;

        return $this;
    }

    /**
     * Get intensidad
     *
     * @return integer 
     */
    public function getIntensidad()
    {
        return $this->intensidad;
    }

    /**
     * Set tipoDolor
     *
     * @param string $tipoDolor
     * @return DatosAnamnesis
     */
    public function setTipoDolor($tipoDolor)
    {
        $this->tipoDolor = $tipoDolor;

        return $this;
    }

    /**
     * Get tipoDolor
     *
     * @return string 
     */
    public function getTipoDolor()
    {
        return $this->tipoDolor;
    }

    /**
     * Set formulaMetatarsal
     *
     * @param string $formulaMetatarsal
     * @return DatosAnamnesis
     */
    public function setFormulaMetatarsal($formulaMetatarsal)
    {
        $this->formulaMetatarsal = $formulaMetatarsal;

        return $this;
    }

    /**
     * Get formulaMetatarsal
     *
     * @return string 
     */
    public function getFormulaMetatarsal()
    {
        return $this->formulaMetatarsal;
    }

    /**
     * Set formulaDigital
     *
     * @param string $formulaDigital
     * @return DatosAnamnesis
     */
    public function setFormulaDigital($formulaDigital)
    {
        $this->formulaDigital = $formulaDigital;

        return $this;
    }

    /**
     * Get formulaDigital
     *
     * @return string 
     */
    public function getFormulaDigital()
    {
        return $this->formulaDigital;
    }

    /**
     * Set anamnesis
     *
     * @param \AppBundle\Entity\Anamnesis $anamnesis
     * @return DatosAnamnesis
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
