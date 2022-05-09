<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Service;

use Cake\Datasource\ConnectionManager;
use Cake\Http\Exception\BadRequestException;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

/**
 * Description of SalaService
 *
 * @author Leonardo
 */
class SalaService
{

    public function saveSala($data)
    {
        if (empty($data['linhagens'])) {
            throw new BadRequestException();
        }

        $table = TableRegistry::getTableLocator()->get('Sala');
        $newEmptyTable = $table->newEmptyEntity();

        $tableSalaLinhagem = TableRegistry::getTableLocator()->get('SalaLinhagem');
        $newEmptyTableSalaLinhagem = $tableSalaLinhagem->newEmptyEntity();

        $newEmptyTable->num_sala = $data['num_sala'];

        $connection = ConnectionManager::get('default');


        $connection->transactional(function () use ($table, $newEmptyTable, $data, $tableSalaLinhagem, $newEmptyTableSalaLinhagem) {

            $saveSala = $table->saveOrFail($newEmptyTable, ['atomic' => false]);

            foreach ($data['linhagens'] as $row) {


                $newEmptyTableSalaLinhagem->sala_id = $saveSala->id;
                $newEmptyTableSalaLinhagem->linhagem_id = $row;

                $tableSalaLinhagem->saveOrFail($newEmptyTableSalaLinhagem, ['atomic' => false]);

                $newEmptyTableSalaLinhagem = $tableSalaLinhagem->newEmptyEntity();
            }

        });

    }

    public function saveTemperaturaUmidade($data)
    {
        $table = TableRegistry::getTableLocator()->get('TemperaturaUmidade');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);

        $table->saveOrFail($mapTable);
    }

    public function getTemperaturaUmidade(): Query
    {
        $table = TableRegistry::getTableLocator()->get('TemperaturaUmidade');

        return $table->find('all')->contain(['Sala']);

    }

}
