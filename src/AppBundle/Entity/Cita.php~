<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cita
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Cita
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idCita", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idCita;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaCreacion", type="date")
     */
    private $fechaCreacion;

    /**
     * @var string
     *
     * @ORM\Column(name="MotivoConsulta", type="string", length=255,nullable=true)
     */
    private $motivoConsulta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HoraInicio", type="datetime",nullable=true)
     */
    private $horaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HoraFin", type="datetime",nullable=true)
     */
    private $horaFin;

    /**
     * @var string
     *
     * @ORM\Column(name="Estado", type="string", length=20)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaUltimaModificacion", type="datetime",nullable=true)
     */
    private $fechaUltimaModificacion;

    /**
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumn(name="Paciente_idPaciente", referencedColumnName="idPaciente",nullable=false)
     **/
    private $paciente;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="Usuario_idUsuarioCreador", referencedColumnName="id",nullable=false)
     **/
    private $usuarioCreador;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="Usuario_idUsuarioModificacion", referencedColumnName="id")
     **/
    private $usuarioModificacion;

    /**
     * @ORM\ManyToOne(targetEntity="Gabinete")
     * @ORM\JoinColumn(name="Gabinete_idGabinete", referencedColumnName="idGabinete")
     **/
    private $gabinete;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getIdCita()
    {
        return $this->idCita;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Cita
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Cita
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set motivoConsulta
     *
     * @param string $motivoConsulta
     * @return Cita
     */
    public function setMotivoConsulta($motivoConsulta)
    {
        $this->motivoConsulta = $motivoConsulta;

        return $this;
    }

    /**
     * Get motivoConsulta
     *
     * @return string 
     */
    public function getMotivoConsulta()
    {
        return $this->motivoConsulta;
    }

    /**
     * Set horaInicio
     *
     * @param \DateTime $horaInicio
     * @return Cita
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return \DateTime 
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set horaFin
     *
     * @param \DateTime $horaFin
     * @return Cita
     */
    public function setHoraFin($horaFin)
    {
        $this->horaFin = $horaFin;

        return $this;
    }

    /**
     * Get horaFin
     *
     * @return \DateTime 
     */
    public function getHoraFin()
    {
        return $this->horaFin;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Cita
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
     * Set fechaUltimaModificacion
     *
     * @param \DateTime $fechaUltimaModificacion
     * @return Cita
     */
    public function setFechaUltimaModificacion($fechaUltimaModificacion)
    {
        $this->fechaUltimaModificacion = $fechaUltimaModificacion;

        return $this;
    }

    /**
     * Get fechaUltimaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaUltimaModificacion()
    {
        return $this->fechaUltimaModificacion;
    }

    /**
     * Set paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     * @return Cita
     */
    public function setPaciente(\AppBundle\Entity\Paciente $paciente)
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
     * Set usuarioCreador
     *
     * @param \AppBundle\Entity\Usuario $usuarioCreador
     * @return Cita
     */
    public function setUsuarioCreador(\AppBundle\Entity\Usuario $usuarioCreador)
    {
        $this->usuarioCreador = $usuarioCreador;

        return $this;
    }

    /**
     * Get usuarioCreador
     *
     * @return \AppBundle\Entity\Usuario 
     */
    public function getUsuarioCreador()
    {
        return $this->usuarioCreador;
    }

    /**
     * Set usuarioModificacion
     *
     * @param \AppBundle\Entity\Usuario $usuarioModificacion
     * @return Cita
     */
    public function setUsuarioModificacion(\AppBundle\Entity\Usuario $usuarioModificacion = null)
    {
        $this->usuarioModificacion = $usuarioModificacion;

        return $this;
    }

    /**
     * Get usuarioModificacion
     *
     * @return \AppBundle\Entity\Usuario 
     */
    public function getUsuarioModificacion()
    {
        return $this->usuarioModificacion;
    }

    /**
     * Set gabinete
     *
     * @param \AppBundle\Entity\Gabinete $gabinete
     * @return Cita
     */
    public function setGabinete(\AppBundle\Entity\Gabinete $gabinete = null)
    {
        $this->gabinete = $gabinete;

        return $this;
    }

    /**
     * Get gabinete
     *
     * @return \AppBundle\Entity\Gabinete 
     */
    public function getGabinete()
    {
        return $this->gabinete;
    }

    public function __construct()
    {
        $this->setFechaCreacion(new \DateTime('now'));
        $this->setFechaUltimaModificacion(new \DateTime('now'));
    }

}
