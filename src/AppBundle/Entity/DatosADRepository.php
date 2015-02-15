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

            $dad = $q->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true)->getArrayResult(); // no se porque array_merge no va ..
            foreach($dad as $d){
                foreach($d as $indice=>$campo){
                    //echo $campo.".".$indice;
                    //echo "tipo".gettype($campo);
                    if(gettype($campo)=="resource") $d[$indice] =stream_get_contents($campo);
                }
                //$d["imagenDolor"]=stream_get_contents($d["imagenDolor"]);
                //$d["imagenDolor2"]=stream_get_contents($d["imagenDolor2"]);
                array_push($resultado,$d);
            }

        }

        return $resultado;
    }

}