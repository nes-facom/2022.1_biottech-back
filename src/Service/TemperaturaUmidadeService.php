<?php

namespace App\Service;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

class TemperaturaUmidadeService
{

    public function getTemperaturaUmidades($search, $year, $active): Query
    {

        $findInTable = [
            'LOWER(concat(".", data, ".",
             IF(temp_matutino=null, temp_matutino , ""), ".",
             IF(ur_matutino=null, ur_matutino , ""), ".",
             IF(temp_vespertino=null, temp_vespertino , ""), ".",
             IF(ur_vespertino=null, ur_vespertino , ""), ".",
             IF(observacoes=null, observacoes , ""), ".")) LIKE' => strtolower("%" . $search . "%")
        ];

        $table = TableRegistry::getTableLocator()->get('TemperaturaUmidade');

        return $table->find()->contain('Sala')->where([
            'YEAR(data)' => $year
        ])->andWhere($findInTable)->andWhere(['TemperaturaUmidade.active' => $active]);
    }

}
