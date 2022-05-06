<?php

namespace App\Service;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

class CaixaMatrizService
{

    public function saveCaixaMatriz($data)
    {

        $tableCaixaMatriz = TableRegistry::getTableLocator()->get('CaixaMatriz');
        $newEmptyTableCaixaMatriz = $tableCaixaMatriz->newEmptyEntity();

        $tableCaixaCaixaMatriz = TableRegistry::getTableLocator()->get('CaixaCaixaMatriz');
        $newEmptyTableCaixaCaixaMatriz = $tableCaixaCaixaMatriz->newEmptyEntity();

        $tableCaixa = TableRegistry::getTableLocator()->get('Caixa')->find();

        $newEmptyTableCaixaMatriz->caixa_matriz_numero = $data['caixa_matriz_numero'];
        $newEmptyTableCaixaMatriz->data_acasalamento = $data['data_acasalamento'];
        $newEmptyTableCaixaMatriz->saida_da_colonia = $data['saida_da_colonia'];
        $newEmptyTableCaixaMatriz->data_obito = $data['data_obito'];

        $connection = ConnectionManager::get('default');

        $connection->transactional(function () use ($tableCaixaMatriz, $newEmptyTableCaixaMatriz, $data, $tableCaixaCaixaMatriz, $newEmptyTableCaixaCaixaMatriz, $tableCaixa) {

            $saveCaixaMatriz = $tableCaixaMatriz->saveOrFail($newEmptyTableCaixaMatriz, ['atomic' => false]);

            foreach ($data['caixas'] as $row) {

                $newEmptyTableCaixaCaixaMatriz->caixa_matriz_id = $saveCaixaMatriz->id;

                $newEmptyTableCaixaCaixaMatriz->caixa_id = $tableCaixa->where(['caixa_numero' => $row['caixa_numero']])->first()->id;

                $newEmptyTableCaixaCaixaMatriz->peso = $row["peso"];

                $tableCaixaCaixaMatriz->saveOrFail($newEmptyTableCaixaCaixaMatriz, ['atomic' => false]);

                $newEmptyTableCaixaCaixaMatriz = $tableCaixaCaixaMatriz->newEmptyEntity();
                $tableCaixa = TableRegistry::getTableLocator()->get('Caixa')->find();
            }

        });


    }

    public function getProgamacaoAcasalamento(): Query
    {
        $table = TableRegistry::getTableLocator()->get('Caixamatriz');

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
        ]);

    }

    public function getMatrizes(): Query
    {
        $table = TableRegistry::getTableLocator()->get('Caixamatriz');

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
        ]);
    }

}
