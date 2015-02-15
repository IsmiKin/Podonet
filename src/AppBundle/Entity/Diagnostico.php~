<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Diagnostico
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\DiagnosticoRepository")
 */
class Diagnostico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idDiagnostico", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idDiagnostico;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="Tratamiento", type="string", length=255,nullable=true)
     */
    private $tratamiento;

    /**
     * @var string
     *
     * @ORM\Column(name="Observaciones", type="string", length=255,nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="Diagnostico", type="string", length=255,nullable=true)
     */
    private $diagnostico;

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
     * @ORM\JoinColumn(name="Usuario_idUsuario", referencedColumnName="id",nullable=false)
     **/
    private $usuario;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getIdDiagnostico()
    {
        return $this->idDiagnostico;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Diagnostico
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
     * Set tratamiento
     *
     * @param string $tratamiento
     * @return Diagnostico
     */
    public function setTratamiento($tratamiento)
    {
        $this->tratamiento = $tratamiento;

        return $this;
    }

    /**
     * Get tratamiento
     *
     * @return string 
     */
    public function getTratamiento()
    {
        return $this->tratamiento;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Diagnostico
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set diagnostico
     *
     * @param string $diagnostico
     * @return Diagnostico
     */
    public function setDiagnostico($diagnostico)
    {
        $this->diagnostico = $diagnostico;

        return $this;
    }

    /**
     * Get diagnostico
     *
     * @return string 
     */
    public function getDiagnostico()
    {
        return $this->diagnostico;
    }

    /**
     * Set evolucion
     *
     * @param string $evolucion
     * @return Diagnostico
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
     * @return Diagnostico
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
     * @return Diagnostico
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fecha = $this->setFecha(new \DateTime('now'));
        $this->patologias = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add patologias
     *
     * @param \AppBundle\Entity\Patologia $patologias
     * @return Diagnostico
     */
    public function addPatologia(\AppBundle\Entity\Patologia $patologias)
    {
        $this->patologias[] = $patologias;

        return $this;
    }

    /**
     * Remove patologias
     *
     * @param \AppBundle\Entity\Patologia $patologias
     */
    public function removePatologia(\AppBundle\Entity\Patologia $patologias)
    {
        $this->patologias->removeElement($patologias);
    }

    /**
     * Get patologias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPatologias()
    {
        return $this->patologias;
    }


}
