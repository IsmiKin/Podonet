<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosSemipermanentes
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class DatosSemipermanentes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idDatosSemipermanentes", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idDatosSemipermanentes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha", type="date")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="Medicacion", type="string", length=255,nullable=true)
     */
    private $medicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="Alergias", type="string", length=255,nullable=true)
     */
    private $alergias;

    /**
     * @var string
     *
     * @ORM\Column(name="Descripcion", type="string", length=255,nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="Talla", type="decimal",scale=2,nullable=true)
     */
    private $talla;

    /**
     * @var string
     *
     * @ORM\Column(name="Peso", type="decimal",scale=2,nullable=true)
     */
    private $peso;

    /**
     * @var string
     *
     * @ORM\Column(name="PieDominante", type="string", length=20,nullable=true)
     */
    private $pieDominante;

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
    public function getIdDatosSemipermanentes()
    {
        return $this->idDatosSemipermanentes;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return DatosSemipermanentes
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
     * Set medicacion
     *
     * @param string $medicacion
     * @return DatosSemipermanentes
     */
    public function setMedicacion($medicacion)
    {
        $this->medicacion = $medicacion;

        return $this;
    }

    /**
     * Get medicacion
     *
     * @return string 
     */
    public function getMedicacion()
    {
        return $this->medicacion;
    }

    /**
     * Set alergias
     *
     * @param string $alergias
     * @return DatosSemipermanentes
     */
    public function setAlergias($alergias)
    {
        $this->alergias = $alergias;

        return $this;
    }

    /**
     * Get alergias
     *
     * @return string 
     */
    public function getAlergias()
    {
        return $this->alergias;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return DatosSemipermanentes
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
     * Set talla
     *
     * @param string $talla
     * @return DatosSemipermanentes
     */
    public function setTalla($talla)
    {
        $this->talla = $talla;

        return $this;
    }

    /**
     * Get talla
     *
     * @return string 
     */
    public function getTalla()
    {
        return $this->talla;
    }

    /**
     * Set peso
     *
     * @param string $peso
     * @return DatosSemipermanentes
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;

        return $this;
    }

    /**
     * Get peso
     *
     * @return string 
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Set pieDominante
     *
     * @param string $pieDominante
     * @return DatosSemipermanentes
     */
    public function setPieDominante($pieDominante)
    {
        $this->pieDominante = $pieDominante;

        return $this;
    }

    /**
     * Get pieDominante
     *
     * @return string 
     */
    public function getPieDominante()
    {
        return $this->pieDominante;
    }

    /**
     * Set paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     * @return DatosSemipermanentes
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
     * @return DatosSemipermanentes
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
