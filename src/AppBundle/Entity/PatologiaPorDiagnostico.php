<?php
/**
 * Created by PhpStorm.
 * User: kuku
 * Date: 22/01/15
 * Time: 0:18
 */

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
     * @ORM\Column(name="Diagnostico_idDiagnostico", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idDiagnostico;

    /**
     * @var integer
     *
     * @ORM\Column(name="Patologia_idPatologia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPatologia;

    /**
     * @return int
     */
    public function getIdPatologia()
    {
        return $this->idPatologia;
    }

    /**
     * @param int $idPatologia
     */
    public function setIdPatologia($idPatologia)
    {
        $this->idPatologia = $idPatologia;
    }

    /**
     * @return int
     */
    public function getIdDiagnostico()
    {
        return $this->idDiagnostico;
    }

    /**
     * @param int $idDiagnostico
     */
    public function setIdDiagnostico($idDiagnostico)
    {
        $this->idDiagnostico = $idDiagnostico;
    }

}
