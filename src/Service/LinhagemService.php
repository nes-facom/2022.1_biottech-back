<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Service;

use Cake\ORM\TableRegistry;

/**
 * Description of LinhagemService
 *
 * @author Leonardo
 */
class LinhagemService {
    
    public function saveLinhagem($data) {
        $table = \Cake\ORM\TableRegistry::getTableLocator()->get('Linhagem');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable= $table->patchEntity($newEmptyTable, $data);

        $saveObject = $table->save($mapTable);

        return $saveObject;
    }
}
