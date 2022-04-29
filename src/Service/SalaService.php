<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Service;

use Cake\ORM\TableRegistry;

/**
 * Description of SalaService
 *
 * @author Leonardo
 */
class SalaService {

    public function saveSala($data) {

        if (empty($data['linhagens'])) {
            return false;
        }


        $table = TableRegistry::getTableLocator()->get('Sala');
        $newEmptyTable = $table->newEmptyEntity();

        $tableSalaLinhagem = TableRegistry::getTableLocator()->get('SalaLinhagem');
        $newEmptyTableSalaLinhagem = $tableSalaLinhagem->newEmptyEntity();

        $newEmptyTable->num_sala = $data['num_sala'];

        $saveSala = $table->save($newEmptyTable);

        if ($saveSala) {
            foreach ($data['linhagens'] as $row) {
          

                $newEmptyTableSalaLinhagem->sala_id = $saveSala->id;
                $newEmptyTableSalaLinhagem->linhagem_id = $row;

                $tableSalaLinhagem->save($newEmptyTableSalaLinhagem);
                
                $newEmptyTableSalaLinhagem = $tableSalaLinhagem->newEmptyEntity();
            }

            return true;
        } else {
            return false;
        }
    }
    
    public function saveTemperaturaUmidade($data) {
        $table = TableRegistry::getTableLocator()->get('TemperaturaUmidade');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);


        $saveObject = $table->save($mapTable);

        return $saveObject;
    }

}
