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
 * Description of PesquisadorSerice
 *
 * @author Leonardo
 */
class PesquisadorService
{

    public function savePesquisadorUpdate($data, $id)
    {
        if (empty($data['telefones'])) {
            throw new BadRequestException('É obrigatório pelo menos um telefone.');
        }

        $table = TableRegistry::getTableLocator()->get('Pesquisador');
        $newEmptyTable = $table->newEmptyEntity();
        $tableTelefone = TableRegistry::getTableLocator()->get('Telefones');
        $newEmptyTableTelefone = $tableTelefone->newEmptyEntity();

        if (isset($id)) {
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            } catch (Exception $e) {
                throw new BadRequestException('ID não encontrado.');
            }

            if ($table->find('all')->where(['id' => $id])->first()->email != $data['email']) {
                if ($table->find('all')->where(['email' => $data['email']])->first() != null) {
                    throw new BadRequestException('Já existe um Pesquisador com esse email.');
                }
            }

            foreach ($tableTelefone->find()->select('id')->where(['pesquisador_id' => $newEmptyTable['id']]) as $row) {
                $tableTelefone->deleteOrFail($row);
            }
        } else {
            if ($table->find('all')->where(['email' => $data['email']])->first() != null) {
                throw new BadRequestException('Já existe um Pesquisador com esse email.');
            }
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
            return $connection->transactional(function () use ($table, $newEmptyTable, $data, $newEmptyTableTelefone, $tableTelefone) {
                $savePesquisador = $table->saveOrFail($newEmptyTable, ['atomic' => true]);

                foreach ($data['telefones'] as $row) {

                    $newEmptyTableTelefone->pesquisador_id = $savePesquisador->id;
                    $newEmptyTableTelefone->telefone = $row;

                    $tableTelefone->saveOrFail($newEmptyTableTelefone, ['atomic' => true]);

                    $newEmptyTableTelefone = $tableTelefone->newEmptyEntity();
                }

                return $table->find('all')->where(['id' => $savePesquisador->id])->first();
            });

        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }


    public function getPesquisador($search, $active): Query
    {
        $findInTable = [
            'LOWER(concat(".", nome, ".",
             instituicao, ".",
             setor, ".",
             pos, ".",
             ramal, ".",
             email, ".",
             orientador, ".")) LIKE' => strtolower("%" . $search . "%")
        ];

        $table = TableRegistry::getTableLocator()->get('Pesquisador');

        return $table->find('all')->contain(['Telefones'])
            ->where($findInTable)->andWhere(['Pesquisador.active' => $active]);
    }

    public function getPesquisadores($search, $active): Query
    {
        $findInTable = [
            'LOWER(concat(".", nome, ".",
             instituicao, ".",
             setor, ".",
             pos, ".",
             ramal, ".",
             email, ".",
             orientador, ".")) LIKE' => strtolower("%" . $search . "%")
        ];

        $table = TableRegistry::getTableLocator()->get('Pesquisador');

        return $table->find('all')->contain(['Telefones'])
            ->where($findInTable)->andWhere(['Pesquisador.active' => $active]);
    }

    public function updateActiveAndDisable($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('Pesquisador');
        $tableFind = TableRegistry::getTableLocator()->get('Pesquisador')->find();

        try {
            $pesquisador = $tableFind->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Pesquisador não encontrado.');
        }

        $pesquisador->active = $active;

        try {
            return $table->saveOrFail($pesquisador);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }
}
