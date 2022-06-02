<?php

namespace App\Service;

use Cake\Datasource\ConnectionManager;
use Cake\Http\Exception\BadRequestException;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Exception;

class CaixaMatrizService
{

    public function saveCaixaMatrizAndUpdate($data, $id)
    {
        $tableCaixaMatriz = TableRegistry::getTableLocator()->get('CaixaMatriz');
        $newEmptyTableCaixaMatriz = $tableCaixaMatriz->newEmptyEntity();

        $tableCaixaCaixaMatriz = TableRegistry::getTableLocator()->get('CaixaCaixaMatriz');
        $newEmptyTableCaixaCaixaMatriz = $tableCaixaCaixaMatriz->newEmptyEntity();

        $tableCaixa = TableRegistry::getTableLocator()->get('Caixa')->find();

        if (isset($id)) {
            try {
                $newEmptyTableCaixaMatriz = $tableCaixaMatriz->find()->where(['id' => $id])->where()->firstOrFail();
            } catch (Exception $e) {
                throw new BadRequestException('ID não encontrado.');
            }

            if ($tableCaixaMatriz->find('all')->where(['id' => $id])->first()->caixa_matriz_numero != $data['caixa_matriz_numero']) {
                if ($tableCaixaMatriz->find('all')->where(['caixa_matriz_numero' => $data['caixa_matriz_numero']])->first() != null) {
                    throw new BadRequestException('Já existe uma Caixa Matriz com esse número.');
                }
            }

            foreach ($tableCaixaCaixaMatriz->find()->select('id')->where(['caixa_matriz_id' => $newEmptyTableCaixaMatriz['id']]) as $row) {
                $tableCaixaCaixaMatriz->deleteOrFail($row);
            }
        } else {
            if ($tableCaixaMatriz->find('all')->where(['caixa_matriz_numero' => $data['caixa_matriz_numero']])->first() != null) {
                throw new BadRequestException('Já existe uma Caixa Matriz com esse número.');
            }
        }

        try {
            $newEmptyTableCaixaMatriz->caixa_matriz_numero = $data['caixa_matriz_numero'];
            $newEmptyTableCaixaMatriz->data_acasalamento = $data['data_acasalamento'];
            $newEmptyTableCaixaMatriz->saida_da_colonia = $data['saida_da_colonia'];
            $newEmptyTableCaixaMatriz->data_obito = $data['data_obito'];

            $connection = ConnectionManager::get('default');

            return $connection->transactional(function () use ($tableCaixaMatriz, $newEmptyTableCaixaMatriz, $data, $tableCaixaCaixaMatriz, $newEmptyTableCaixaCaixaMatriz, $tableCaixa) {

                $saveCaixaMatriz = $tableCaixaMatriz->saveOrFail($newEmptyTableCaixaMatriz, ['atomic' => true]);

                foreach ($data['caixas'] as $row) {

                    $newEmptyTableCaixaCaixaMatriz->caixa_matriz_id = $saveCaixaMatriz->id;

                    $newEmptyTableCaixaCaixaMatriz->caixa_id = $tableCaixa->where(['caixa_numero' => $row['caixa_numero']])->first()->id;

                    $newEmptyTableCaixaCaixaMatriz->peso = $row["peso"];

                    $tableCaixaCaixaMatriz->saveOrFail($newEmptyTableCaixaCaixaMatriz, ['atomic' => true]);

                    $newEmptyTableCaixaCaixaMatriz = $tableCaixaCaixaMatriz->newEmptyEntity();
                    $tableCaixa = TableRegistry::getTableLocator()->get('Caixa')->find();
                }

                return $saveCaixaMatriz;
            });
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function getProgamacaoAcasalamento($search, $year, $active): Query
    {
        $table = TableRegistry::getTableLocator()->get('CaixaMatriz');

        $findInTable = [
            'LOWER(concat(".", caixa_matriz_numero, ".",
             data_acasalamento, ".",
             IF(saida_da_colonia=null, saida_da_colonia , ""), ".")) LIKE' => strtolower("%" . $search . "%")

        ];

        return $table->find('all')->select(['id',
            'caixa_matriz_numero',
            'data_acasalamento',
            'saida_da_colonia',
        ])->contain([
            'Caixa' => [
                'fields' => [
                    'id',
                    'caixa_numero',
                    'nascimento'
                ]
            ]
        ])->where([
            'YEAR(data_acasalamento)' => $year
        ])->andWhere($findInTable)->andWhere(['CaixaMatriz.active' => $active]);
    }

    public function getMatrizes($search, $year, $active): Query
    {
        $table = TableRegistry::getTableLocator()->get('CaixaMatriz');

        $findInTable = [
            'LOWER(concat(".", caixa_matriz_numero, ".",
             data_acasalamento, ".",
             IF(saida_da_colonia=null, saida_da_colonia , ""), ".",
             IF(data_obito=null, data_obito , ""), ".")) LIKE' => strtolower("%" . $search . "%")
        ];

        return $table->find('all')->select(['id',
            'caixa_matriz_numero',
            'data_acasalamento',
            'saida_da_colonia',
            'data_obito',
        ])->contain([
            'Parto' => [
                'fields' => [
                    'id',
                    'caixa_matriz_id',
                    'numero_parto',
                    'data_parto',
                    'num_macho',
                    'num_femea',
                    'des_macho',
                    'des_femea',
                    'qtd_canib',
                    'qtd_gamba',
                    'qtd_outros'
                ]
            ]
        ])->contain([
            'Caixa' => [
                'fields' => [
                    'id',
                    'linhagem_id',
                    'caixa_matriz_id',
                    'caixa_numero',
                    'nascimento',
                    'sexo',
                    'num_animais',
                    'qtd_saida',
                    'ultima_saida',
                ],
                'Linhagem' => [
                    'fields' => [
                        'nome_linhagem'
                    ]
                ]
            ]
        ])->where([
            'YEAR(data_acasalamento)' => $year
        ])->andWhere($findInTable)->andWhere(['CaixaMatriz.active' => $active]);
    }

    public function getCaixaMatrizes($search, $year, $active): Query
    {
        $table = TableRegistry::getTableLocator()->get('CaixaMatriz');

        $findInTable = [
            'LOWER(concat(".", caixa_matriz_numero, ".",
             data_acasalamento, ".",
             IF(saida_da_colonia=null, saida_da_colonia , ""), ".",
             IF(data_obito=null, data_obito , ""), ".")) LIKE' => strtolower("%" . $search . "%")
        ];

        return $table->find('all')->select(['id',
            'caixa_matriz_numero',
            'data_acasalamento',
            'saida_da_colonia',
            'data_obito',
        ])->contain([
            'Caixa' => [
                'fields' => [
                    'caixa_numero',
                ]
            ]
        ])->where([
            'YEAR(data_acasalamento)' => $year
        ])->andWhere($findInTable)->andWhere(['CaixaMatriz.active' => $active]);


    }

    public function updateActiveAndDisable($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('CaixaMatriz');
        $tableFind = TableRegistry::getTableLocator()->get('CaixaMatriz')->find();

        try {
            $caixaMatriz = $tableFind->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Caixa Matriz não encontrado.');
        }

        $caixaMatriz->active = $active;

        try {
            return $table->saveOrFail($caixaMatriz);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

}
