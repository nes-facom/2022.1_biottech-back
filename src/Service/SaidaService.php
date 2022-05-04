<?php

namespace App\Service;
use Cake\ORM\TableRegistry;

class SaidaService
{

    public function saveSaida($data) {
        $table = TableRegistry::getTableLocator()->get('Saida');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);

        $table->saveOrFail($mapTable);
    }

}
