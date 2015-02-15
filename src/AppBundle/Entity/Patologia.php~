<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Patologia
 *
 * @ORM\Table(name="Patologia")
 * @ORM\Entity
 */
class Patologia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPatologia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPatologia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=60)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Categoria", type="string", length=60,nullable=true)
     */
    private $categoria;

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
    public function getIdPatologia()
    {
        return $this->idPatologia;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Patologia
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
     * Set nombre
     *
     * @param string $nombre
     * @return Patologia
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
     * Set categoria
     *
     * @param string $categoria
     * @return Patologia
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     * @return Patologia
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
        //$this->fecha = $this->setFecha(new \DateTime('now'));
        $this->diagnosticos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add diagnosticos
     *
     * @param \AppBundle\Entity\Diagnostico $diagnosticos
     * @return Patologia
     */
    public function addDiagnostico(\AppBundle\Entity\Diagnostico $diagnosticos)
    {
        $this->diagnosticos[] = $diagnosticos;

        return $this;
    }

    /**
     * Remove diagnosticos
     *
     * @param \AppBundle\Entity\Diagnostico $diagnosticos
     */
    public function removeDiagnostico(\AppBundle\Entity\Diagnostico $diagnosticos)
    {
        $this->diagnosticos->removeElement($diagnosticos);
    }

    /**
     * Get diagnosticos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDiagnosticos()
    {
        return $this->diagnosticos;
    }
}
