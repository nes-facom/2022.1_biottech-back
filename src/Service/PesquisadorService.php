<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Service;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

/**
 * Description of PesquisadorSerice
 *
 * @author Leonardo
 */
class PesquisadorService
{

    public function savePesquisador($data)
    {
        if (empty($data['telefones'])) {
            return false;
        }

        $table = TableRegistry::getTableLocator()->get('Pesquisador');
        $newEmptyTable = $table->newEmptyEntity();

        $tableTelefone = TableRegistry::getTableLocator()->get('Telefones');
        $newEmptyTableTelefone = $tableTelefone->newEmptyEntity();

        $newEmptyTable->nome = $data['nome'];
        $newEmptyTable->instituicao = $data['instituicao'];
        $newEmptyTable->setor = $data['setor'];
        $newEmptyTable->pos = $data['pos'];
        $newEmptyTable->ramal = $data['ramal'];
        $newEmptyTable->email = $data['email'];
        $newEmptyTable->orientador = $data['orientador'];

        $connection = ConnectionManager::get('default');
        $connection->transactional(function () use ($table, $newEmptyTable, $data, $newEmptyTableTelefone, $tableTelefone) {
            $savePesquisador = $table->saveOrFail($newEmptyTable, ['atomic' => false]);

            foreach ($data['telefones'] as $row) {

                $newEmptyTableTelefone->pesquisador_id = $savePesquisador->id;
                $newEmptyTableTelefone->telefone = $row;

                $tableTelefone->saveOrFail($newEmptyTableTelefone, ['atomic' => false]);

                $newEmptyTableTelefone = $tableTelefone->newEmptyEntity();
            }
        });
    }
}
