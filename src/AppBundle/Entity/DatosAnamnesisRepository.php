<?php
/**
 * Created by PhpStorm.
 * User: ismikin
 * Date: 4/02/15
 * Time: 21:05
 */

namespace AppBundle\Entity;


use Doctrine\ORM\EntityRepository;

class DatosAnamnesisRepository extends EntityRepository{

    public function getBySomeAnamnesis($todasanamnesis)
    {
        $resultado = array();
        foreach($todasanamnesis as $anamnesis){
            $q = $this->createQueryBuilder('d')
                ->where('d.anamnesis = :anamnesis ')
                ->setParameter('anamnesis',$anamnesis)
                ->getQuery();

            $dad = $q->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true)->getArrayResult(); // no se porque array_merge no va ..
            foreach($dad as $d)     array_push($resultado,$d);

        }

        return $resultado;
    }

}