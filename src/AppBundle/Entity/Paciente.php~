<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paciente
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Paciente
{

    /**
     * @var integer
     *
     * @ORM\Column(name="idPaciente", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPaciente;

    /**
     * @var string
     *
     * @ORM\Column(name="Codigo", type="string", length=45)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=60)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Apellidos", type="string", length=65, nullable=true)
     */
    private $apellidos;


    /**
     * Get idPaciente
     *
     * @return integer 
     */
    public function getIdPaciente()
    {
        return $this->idPaciente;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return Paciente
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Paciente
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
     * Set apellidos
     *
     * @param string $apellidos
     * @return Paciente
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }
}
