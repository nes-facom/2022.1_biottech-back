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
             temp_matutino, ".",
             ur_matutino, ".",
             temp_vespertino, ".",
             ur_vespertino, ".",
             observacoes, ".")) LIKE' => strtolower("%" . $search . "%")
        ];

        $table = TableRegistry::getTableLocator()->get('TemperaturaUmidade');

        return $table->find()->contain('Sala')->where([
            'YEAR(data)' => $year
        ])->andWhere($findInTable)->andWhere(['TemperaturaUmidade.active' => $active]);
    }

}
