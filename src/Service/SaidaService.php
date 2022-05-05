<?php

namespace App\Service;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

class SaidaService
{

    public function saveSaida($data)
    {
        $tableSaida = TableRegistry::getTableLocator()->get('Saida');
        $newEmptyTableSaida = $tableSaida->newEmptyEntity();

        $tablePrevisaoSaida = TableRegistry::getTableLocator()->get('PrevisaoSaida');
        $newEmptyTablePrevisaoSaida = $tablePrevisaoSaida->newEmptyEntity();

        $tablePrevisao = TableRegistry::getTableLocator()->get('Previsao');

        $newEmptyTableSaida->caixa_id = $data['caixa_id'];
        $newEmptyTableSaida->data_saida = $data['data_saida'];
        $newEmptyTableSaida->tipo_saida = $data['tipo_saida'];
        $newEmptyTableSaida->usuario = $data['usuario'];
        $newEmptyTableSaida->num_animais = $data['num_animais'];
        $newEmptyTableSaida->saida = $data['saida'];
        $newEmptyTableSaida->sexo = $data['sexo'];
        $newEmptyTableSaida->sobra = $data['sobra'];
        $newEmptyTableSaida->observacoes = $data['observacoes'];


        $connection = ConnectionManager::get('default');

        $connection->transactional(function () use ($tableSaida, $newEmptyTableSaida, $newEmptyTablePrevisaoSaida, $data, $tablePrevisaoSaida,$tablePrevisao) {
            $saveSaida = $tableSaida->saveOrFail($newEmptyTableSaida, ['atomic' => false]);

            if ($data['tipo_saida'] == 'fornecimento') {

                $newEmptyTablePrevisao = $tablePrevisao->find()->where(['id' => $data['previsao_id']])->first();
                $newEmptyTablePrevisao->totalRetirado = $newEmptyTablePrevisao->totalRetirado + $saveSaida->num_animais;
                $tablePrevisao->saveOrFail($newEmptyTablePrevisao);

                $newEmptyTablePrevisaoSaida->previsao_id = $data['previsao_id'];

                $newEmptyTablePrevisaoSaida->saida_id = $saveSaida->id;

                $tablePrevisaoSaida->saveOrFail($newEmptyTablePrevisaoSaida, ['atomic' => false]);
            }

        });

    }

}
