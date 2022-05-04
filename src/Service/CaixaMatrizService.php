<?php

namespace App\Service;

use Cake\Datasource\ConnectionManager;
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

}
