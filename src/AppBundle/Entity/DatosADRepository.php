<?php
/**
 * Created by PhpStorm.
 * User: ismikin
 * Date: 4/02/15
 * Time: 20:16
 */

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;


class DatosADRepository extends EntityRepository{

    public function getBySomeAnamnesis($todasanamnesis)
    {
        $resultado = array();
        foreach($todasanamnesis as $anamnesis){
            $q = $this->createQueryBuilder('d')
                ->where('d.anamnesis = :anamnesis ')
                ->setParameter('anamnesis',$anamnesis)
                ->orderBy('d.fecha','DESC')
                ->getQuery();

            $dad = $q->getArrayResult(); // no se porque array_merge no va ..
            foreach($dad as $d)     array_push($resultado,$d);

        }

        return $resultado;
    }

}