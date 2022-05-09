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
 * Description of PesquisadorSerice
 *
 * @author Leonardo
 */
class PesquisadorService
{

    public function savePesquisador($data)
    {
        if (empty($data['telefones'])) {
            throw new BadRequestException('É obrigatório pelo menos um telefone.');
        }

        $table = TableRegistry::getTableLocator()->get('Pesquisador');
        $newEmptyTable = $table->newEmptyEntity();

        $tableTelefone = TableRegistry::getTableLocator()->get('Telefones');
        $newEmptyTableTelefone = $tableTelefone->newEmptyEntity();

        if ($table->find('all')->where(['email' => $data['email']])->first() != null) {
            throw new BadRequestException('Já existe um Pesquisador com esse nome.');
        }

        $newEmptyTable->nome = $data['nome'];
        $newEmptyTable->instituicao = $data['instituicao'];
        $newEmptyTable->setor = $data['setor'];
        $newEmptyTable->pos = $data['pos'];
        $newEmptyTable->ramal = $data['ramal'];
        $newEmptyTable->email = $data['email'];
        $newEmptyTable->orientador = $data['orientador'];

        try {
            $connection = ConnectionManager::get('default');
            $connection->transactional(function () use ($table, $newEmptyTable, $data, $newEmptyTableTelefone, $tableTelefone) {
                $savePesquisador = $table->saveOrFail($newEmptyTable, ['atomic' => true]);

                foreach ($data['telefones'] as $row) {

                    $newEmptyTableTelefone->pesquisador_id = $savePesquisador->id;
                    $newEmptyTableTelefone->telefone = $row;

                    $tableTelefone->saveOrFail($newEmptyTableTelefone, ['atomic' => true]);

                    $newEmptyTableTelefone = $tableTelefone->newEmptyEntity();
                }
            });

        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }


    public function getPesquisador(): Query
    {
        $table = TableRegistry::getTableLocator()->get('Pesquisador');

        //return $table->find('all')->contain(['Pesquisador']);

        return $table->find('all')->contain(['Telefones']);

    }
}
