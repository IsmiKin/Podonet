<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anamnesis
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Anamnesis
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
     * @var \Date
     *
     * @ORM\Column(name="Fecha", type="date")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="Estado", type="string", length=45)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaModificacion", type="datetime",nullable=true)
     */
    private $fechaModificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="Evolucion", type="string", length=255,nullable=true)
     */
    private $evolucion;

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
     * @param \Date $fecha
     * @return Anamnesis
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \Date
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Anamnesis
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Anamnesis
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set evolucion
     *
     * @param string $evolucion
     * @return Anamnesis
     */
    public function setEvolucion($evolucion)
    {
        $this->evolucion = $evolucion;

        return $this;
    }

    /**
     * Get evolucion
     *
     * @return string 
     */
    public function getEvolucion()
    {
        return $this->evolucion;
    }

    /**
     * Set paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     * @return Anamnesis
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
     * Set usuarioCreador
     *
     * @param \AppBundle\Entity\Usuario $usuarioCreador
     * @return Anamnesis
     */
    public function setUsuarioCreador(\AppBundle\Entity\Usuario $usuarioCreador = null)
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
     * @return Anamnesis
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

    public function __construct()
    {
        $this->setFecha(new \DateTime('now'));
        $this->setFechaModificacion(new \DateTime('now'));
    }

}
