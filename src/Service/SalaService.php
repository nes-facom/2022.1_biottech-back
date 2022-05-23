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
use Exception;

/**
 * Description of SalaService
 *
 * @author Leonardo
 */
class SalaService
{
    public function saveSalaAndUpdate($data, $id)
    {
        if (empty($data['linhagens'])) {
            throw new BadRequestException();
        }

        $table = TableRegistry::getTableLocator()->get('Sala');
        $newEmptyTable = $table->newEmptyEntity();

        $tableSalaLinhagem = TableRegistry::getTableLocator()->get('SalaLinhagem');
        $newEmptyTableSalaLinhagem = $tableSalaLinhagem->newEmptyEntity();

        if (isset($id)) {
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            } catch (Exception $e) {
                throw new BadRequestException('ID não encontrado.');
            }

            if ($table->find('all')->where(['id' => $id])->first()->num_sala != $data['num_sala']) {
                if ($table->find('all')->where(['num_sala' => $data['num_sala']])->first() != null) {
                    throw new BadRequestException('Já existe uma Sala com esse número.');
                }
            }

            foreach ($tableSalaLinhagem->find()->select('id')->where(['sala_id' => $newEmptyTable['id']]) as $row) {
                $tableSalaLinhagem->deleteOrFail($row);
            }
        } else {
            if ($table->find('all')->where(['num_sala' => $data['num_sala']])->first() != null) {
                throw new BadRequestException('Já existe uma Sala com esse número.');
            }
        }


        try {
            $newEmptyTable->num_sala = $data['num_sala'];

            $connection = ConnectionManager::get('default');
            return $connection->transactional(function () use ($table, $newEmptyTable, $data, $tableSalaLinhagem, $newEmptyTableSalaLinhagem) {

                $saveSala = $table->saveOrFail($newEmptyTable, ['atomic' => true]);

                foreach ($data['linhagens'] as $row) {
                    $newEmptyTableSalaLinhagem->sala_id = $saveSala->id;
                    $newEmptyTableSalaLinhagem->linhagem_id = $row;

                    $tableSalaLinhagem->saveOrFail($newEmptyTableSalaLinhagem, ['atomic' => true]);

                    $newEmptyTableSalaLinhagem = $tableSalaLinhagem->newEmptyEntity();
                }
                return $saveSala;
            });
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function saveTemperaturaUmidadeAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('TemperaturaUmidade');
        $newEmptyTable = $table->newEmptyEntity();

        if (isset($id)) {
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            } catch (Exception $e) {
                throw new BadRequestException('ID não encontrado.');
            }
        }

        try {
            return $table->saveOrFail($table->patchEntity($newEmptyTable, $data), ['atomic' => true]);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function getTemperaturaUmidades(): Query
    {
        $table = TableRegistry::getTableLocator()->get('TemperaturaUmidade');

        return $table->find()->select([
                'data',
                'temp_matutino',
                'ur_matutino',
                'temp_vespertino',
                'ur_vespertino',
                'observacoes',
                'active']
        );
    }

    public function getSalas(): Query
    {
        $table = TableRegistry::getTableLocator()->get('Sala');

        return $table->find('all');
    }

}
