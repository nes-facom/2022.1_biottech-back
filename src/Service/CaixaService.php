<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Service;

use Cake\ORM\TableRegistry;

/**
 * Description of CaixaService
 *
 * @author Leonardo
 */
class CaixaService {

    public function saveCaixa($data) {
        $table = TableRegistry::getTableLocator()->get('Caixa');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);
        
      
        $saveObject = $table->save($mapTable);

        return $saveObject;
    }

}
