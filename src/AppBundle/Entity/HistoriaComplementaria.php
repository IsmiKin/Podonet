<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistoriaComplementaria
 *
 * @ORM\Table(name="HistoriaComplementaria")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\HistoriaComplementariaRepository")
 */
class HistoriaComplementaria extends Document
{


    /**
     * @var string
     *
     * @ORM\Column(name="Formato", type="string", length=25,nullable=true)
     */
    private $formato;


    /**
     * @var string
     *
     * @ORM\Column(name="Descripcion", type="string", length=255,nullable=true)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha", type="date",nullable=true)
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumn(name="Paciente_idPaciente", referencedColumnName="idPaciente",nullable=false)
     **/
    private $paciente;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="Usuario_idUsuario", referencedColumnName="id",nullable=false)
     **/
    private $usuario;



    /**
     * Set formato
     *
     * @param string $formato
     * @return HistoriaComplementaria
     */
    public function setFormato($formato)
    {
        $this->formato = $formato;

        return $this;
    }

    /**
     * Get formato
     *
     * @return string 
     */
    public function getFormato()
    {
        return $this->formato;
    }

    /**
     * Set contenido
     *
     * @param binary $contenido
     * @return HistoriaComplementaria
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return binary
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return HistoriaComplementaria
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return HistoriaComplementaria
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
     * Set paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     * @return HistoriaComplementaria
     */
    public function setPaciente(\AppBundle\Entity\Paciente $paciente = null)
    {
        $this->paciente = $paciente;

        return $this;
    }

    /**
     * Get paciente
     *
     * @return \AppBundle\Entity\Paciente 
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     * @return HistoriaComplementaria
     */
    public function setUsuario(\AppBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}
