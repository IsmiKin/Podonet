<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosPersonales
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class DatosPersonales
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idDatosPersonales", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idDatosPersonales;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Telefono", type="string", length=15,nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="NIF", type="string", length=15,nullable=true)
     */
    private $nIF;

    /**
     * @var string
     *
     * @ORM\Column(name="Domicilio", type="string", length=255,nullable=true)
     */
    private $domicilio;

    /**
     * @var integer
     *
     * @ORM\Column(name="CodigoPostal", type="smallint",nullable=true)
     */
    private $codigoPostal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaNacimiento", type="date",nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="Pais", type="string", length=60,nullable=true)
     */
    private $pais;

    /**
     * @var string
     *
     * @ORM\Column(name="Provincia", type="string", length=60,nullable=true)
     */
    private $provincia;

    /**
     * @var string
     *
     * @ORM\Column(name="Localidad", type="string", length=60,nullable=true)
     */
    private $localidad;

    /**
     * @var string
     *
     * @ORM\Column(name="Sexo", type="string", length=10,nullable=true)
     */
    private $sexo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaAlta", type="datetime")
     */
    private $fechaAlta;

    /**
     * @ORM\OneToOne(targetEntity="Paciente")
     * @ORM\JoinColumn(name="Paciente_idPaciente", referencedColumnName="idPaciente",nullable=false)
     **/
    private $paciente;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getIdDatosPersonales()
    {
        return $this->idDatosPersonales;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return DatosPersonales
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return DatosPersonales
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set nIF
     *
     * @param string $nIF
     * @return DatosPersonales
     */
    public function setNIF($nIF)
    {
        $this->nIF = $nIF;

        return $this;
    }

    /**
     * Get nIF
     *
     * @return string 
     */
    public function getNIF()
    {
        return $this->nIF;
    }

    /**
     * Set domicilio
     *
     * @param string $domicilio
     * @return DatosPersonales
     */
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    /**
     * Get domicilio
     *
     * @return string 
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Set codigoPostal
     *
     * @param integer $codigoPostal
     * @return DatosPersonales
     */
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    /**
     * Get codigoPostal
     *
     * @return integer 
     */
    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return DatosPersonales
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set pais
     *
     * @param string $pais
     * @return DatosPersonales
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     * @return DatosPersonales
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set localidad
     *
     * @param string $localidad
     * @return DatosPersonales
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad
     *
     * @return string 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return DatosPersonales
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return DatosPersonales
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime 
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
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
     * Set paciente
     *
     * @param \AppBundle\Entity\Paciente $paciente
     * @return DatosPersonales
     */
    public function setPaciente(\AppBundle\Entity\Paciente $paciente = null)
    {
        $this->paciente = $paciente;

        return $this;
    }

    public function __construct()
    {
        $this->setFechaAlta(new \DateTime('now'));
    }
}
