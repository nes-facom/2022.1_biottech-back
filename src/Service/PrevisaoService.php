<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Service;

use Cake\ORM\TableRegistry;

/**
 * Description of PrevisaoService
 *
 * @author Leonardo
 */
class PrevisaoService {

    public function savePrevisao($data) {
        $table = TableRegistry::getTableLocator()->get('Previsao');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);
        
        $saveObject = $table->save($mapTable);

        
        return $saveObject;
    }

}
