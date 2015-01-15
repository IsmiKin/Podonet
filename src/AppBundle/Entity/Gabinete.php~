<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gabinete
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Gabinete
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idGabinete", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idGabinete;

    /**
     * @var string
     *
     * @ORM\Column(name="Codigo", type="string", length=60)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="Localizacion", type="string", length=60,nullable=true)
     */
    private $localizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="Tipo", type="string", length=20,nullable=true)
     */
    private $tipo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaSuspension", type="datetime",nullable=true)
     */
    private $fechaSuspension;

    /**
     * @var string
     *
     * @ORM\Column(name="Estado", type="string", length=20)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FechaUltimaModificacion", type="datetime")
     */
    private $fechaUltimaModificacion;

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


    public function __construct()
    {
        $this->setFechaUltimaModificacion(new \DateTime('now'));
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getIdGabinete()
    {
        return $this->idGabinete;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return Gabinete
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
     * Set localizacion
     *
     * @param string $localizacion
     * @return Gabinete
     */
    public function setLocalizacion($localizacion)
    {
        $this->localizacion = $localizacion;

        return $this;
    }

    /**
     * Get localizacion
     *
     * @return string 
     */
    public function getLocalizacion()
    {
        return $this->localizacion;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Gabinete
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set fechaSuspension
     *
     * @param \DateTime $fechaSuspension
     * @return Gabinete
     */
    public function setFechaSuspension($fechaSuspension)
    {
        $this->fechaSuspension = $fechaSuspension;

        return $this;
    }

    /**
     * Get fechaSuspension
     *
     * @return \DateTime 
     */
    public function getFechaSuspension()
    {
        return $this->fechaSuspension;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Gabinete
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
     * @return Gabinete
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
     * Set usuarioCreador
     *
     * @param \AppBundle\Entity\Usuario $usuarioCreador
     * @return Gabinete
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
     * @return Gabinete
     */
    public function setUsuarioModificacion(\AppBundle\Entity\Usuario $usuarioModificacion)
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



}
