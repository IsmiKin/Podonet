<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * DiagnosticoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DiagnosticoRepository extends EntityRepository
{
    public function getDiagnosticoByPacienteArray($paciente)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $q = $this->createQueryBuilder('d')
            ->where('d.paciente = :paciente')
            ->setParameter('paciente',$paciente)
            ->getQuery();

        $diagnosticoItera = $q->getArrayResult();

        $diagnosticos = array();
        $repoPat = $em->getRepository("AppBundle:PatologiaPorDiagnostico");
        foreach( $diagnosticoItera as $diag ) {
            $patsDiag = $repoPat->findPatByIdDiagArray($diag["idDiagnostico"]);
            $diag["patologias"]=$patsDiag;
            array_push($diagnosticos,$diag);
        }

        return $diagnosticos;
    }
}