<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosOnicopatis
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class DatosOnicopatis
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idDatosOnicopatis", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idDatosOnicopatis;

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
     * @var binary
     *
     * @ORM\Column(name="ImagenOnicopatica", type="binary",nullable=true)
     */
    private $imagenOnicopatica;

    /**
     * @var integer
     *
     * @ORM\Column(name="PulsoMedioDerechoIzquierdo", type="integer",nullable=true)
     */
    private $pulsoMedioDerechoIzquierdo;

    /**
     * @var integer
     *
     * @ORM\Column(name="TemperaturaPieDerechoIzquierdo", type="integer",nullable=true)
     */
    private $temperaturaPieDerechoIzquierdo;

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
    public function getIdDatosOnicopatis()
    {
        return $this->idDatosOnicopatis;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return DatosOnicopatis
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
     * @return DatosOnicopatis
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
     * Set imagenOnicopatica
     *
     * @param binary $imagenOnicopatica
     * @return DatosOnicopatis
     */
    public function setImagenOnicopatica($imagenOnicopatica)
    {
        $this->imagenOnicopatica = $imagenOnicopatica;

        return $this;
    }

    /**
     * Get imagenOnicopatica
     *
     * @return binary 
     */
    public function getImagenOnicopatica()
    {
        return $this->imagenOnicopatica;
    }

    /**
     * Set pulsoMedioDerechoIzquierdo
     *
     * @param integer $pulsoMedioDerechoIzquierdo
     * @return DatosOnicopatis
     */
    public function setPulsoMedioDerechoIzquierdo($pulsoMedioDerechoIzquierdo)
    {
        $this->pulsoMedioDerechoIzquierdo = $pulsoMedioDerechoIzquierdo;

        return $this;
    }

    /**
     * Get pulsoMedioDerechoIzquierdo
     *
     * @return integer 
     */
    public function getPulsoMedioDerechoIzquierdo()
    {
        return $this->pulsoMedioDerechoIzquierdo;
    }

    /**
     * Set temperaturaPieDerechoIzquierdo
     *
     * @param integer $temperaturaPieDerechoIzquierdo
     * @return DatosOnicopatis
     */
    public function setTemperaturaPieDerechoIzquierdo($temperaturaPieDerechoIzquierdo)
    {
        $this->temperaturaPieDerechoIzquierdo = $temperaturaPieDerechoIzquierdo;

        return $this;
    }

    /**
     * Get temperaturaPieDerechoIzquierdo
     *
     * @return integer 
     */
    public function getTemperaturaPieDerechoIzquierdo()
    {
        return $this->temperaturaPieDerechoIzquierdo;
    }

    /**
     * Set anamnesis
     *
     * @param \AppBundle\Entity\Anamnesis $anamnesis
     * @return DatosOnicopatis
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
