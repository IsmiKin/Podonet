<?php
/**
 * Created by PhpStorm.
 * User: ismikin
 * Date: 4/02/15
 * Time: 21:10
 */

namespace AppBundle\Entity;


use Doctrine\ORM\EntityRepository;

class DatosOnicopatisRepository extends EntityRepository{

    public function getBySomeAnamnesis($todasanamnesis)
    {
        $resultado = array();
        foreach($todasanamnesis as $anamnesis){
            $q = $this->createQueryBuilder('d')
                ->where('d.anamnesis = :anamnesis ')
                ->setParameter('anamnesis',$anamnesis)
                ->getQuery();

            $dad = $q->getArrayResult(); // no se porque array_merge no va ..
            foreach($dad as $d)     array_push($resultado,$d);

        }

        return $resultado;
    }

}