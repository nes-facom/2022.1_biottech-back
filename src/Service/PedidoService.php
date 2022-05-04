<?php

namespace App\Service;

use Cake\ORM\TableRegistry;

class PedidoService
{

    public function getAllPedidos()
    {
        $pedidoTable = TableRegistry::getTableLocator()->get('Pedido');

        $previsaoTable = TableRegistry::getTableLocator()->get('Previsao')->find();

        $saidaTable = TableRegistry::getTableLocator()->get('Saida')->find();

        $previsaoSaidaTable = TableRegistry::getTableLocator()->get('PrevisaoSaida')->find();


        /*$query = $pedidoTable->find('all', ['contain' => ['VinculoInstitucional', 'Projeto', 'Especie', 'LinhaPesquisa'
            , 'NivelProjeto', 'Laboratorio', 'Finalidade', 'Pesquisador', 'Linhagem', 'Previsao']]);*/

        $query = $pedidoTable->find('all')->select(['id',
            'processo_sei',
            'equipe_executora',
            'data_solicitacao',
            'titulo',
            'especificar',
            'exper',
            'num_ceua',
            'vigencia_ceua',
            'num_aprovado',
            'num_solicitado',
            'adendo_1',
            'adendo_2',
            'sexo',
            'idade',
            'peso',
            'observacoes',
            'saldoCEUA' => 'Pedido.num_aprovado - Pedido.num_solicitado + Pedido.adendo_1 + Pedido.adendo_2',
        ])->contain([
            'Linhagem' => [
                'fields' => [
                    'id',
                    'nome_linhagem'
                ]
            ]
        ])->contain([
            'Pesquisador' => [
                'fields' => [
                    'id',
                    'nome',
                    'instituicao',
                    'setor',
                    'pos',
                    'ramal',
                    'email',
                    'orientador'
                ]
            ]
        ])->contain([
            'Finalidade' => [
                'fields' => [
                    'id',
                    'nome_finalidade'
                ]
            ]
        ])->contain([
            'Laboratorio' => [
                'fields' => [
                    'id',
                    'nome_laboratorio'
                ]
            ]
        ])->contain([
            'NivelProjeto' => [
                'fields' => [
                    'id',
                    'nome_nivel_projeto'
                ]
            ]
        ])->contain([
            'LinhaPesquisa' => [
                'fields' => [
                    'id',
                    'nome_linha_pesquisa'
                ]
            ]
        ])->contain([
            'Especie' => [
                'fields' => [
                    'id',
                    'nome_especie'
                ]
            ]
        ])->contain([
            'Projeto' => [
                'fields' => [
                    'id',
                    'nome_projeto'
                ]
            ]
        ])->contain([
            'VinculoInstitucional' => [
                'fields' => [
                    'id',
                    'nome_vinculo_institucional'
                ]
            ]
        ])->contain(['Previsao' => [
            'fields' => [
                'pedido_id',
                'retirada_data',
                'totalRetirado' => $previsaoTable->func()->sum('totalRetirado')
            ]
        ]]);

        /*->contain(['Previsao' => [
               'fields' => [
                   'pedido_id',
                   'retirada_num',
                   'retirada_data',
                   'nice' => $previsaoTable->func()->sum('retirada_num')
               ]
           ]]);*/


        return $query;
    }

    public function saveNivelProjeto($data)
    {
        $table = TableRegistry::getTableLocator()->get('NivelProjeto');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);

        $saveObject = $table->saveOrFail($mapTable);

        return $saveObject;
    }

    public function saveLinhaPesquisa($data)
    {
        $table = TableRegistry::getTableLocator()->get('LinhaPesquisa');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);

        $saveObject = $table->saveOrFail($mapTable);

        return $saveObject;
    }

    public function saveFinalidade($data)
    {
        $table = TableRegistry::getTableLocator()->get('Finalidade');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);

        $saveObject = $table->saveOrFail($mapTable);

        return $saveObject;
    }

    public function saveLaboratorio($data)
    {
        $table = TableRegistry::getTableLocator()->get('Laboratorio');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);

        $saveObject = $table->saveOrFail($mapTable);

        return $saveObject;
    }

    public function saveVinculoInstitucional($data)
    {
        $table = TableRegistry::getTableLocator()->get('VinculoInstitucional');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);

        $saveObject = $table->saveOrFail($mapTable);

        return $saveObject;
    }

    public function saveProjeto($data)
    {
        $table = TableRegistry::getTableLocator()->get('Projeto');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);

        $saveObject = $table->saveOrFail($mapTable);

        return $saveObject;
    }

    public function saveEspecie($data)
    {
        $table = TableRegistry::getTableLocator()->get('Especie');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);

        $saveObject = $table->saveOrFail($mapTable);

        return $saveObject;
    }

    public function savePedido($data)
    {
        $table = TableRegistry::getTableLocator()->get('Pedido');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);

        $table->saveOrFail($mapTable, ['atomic' => false]);

        $table->saveOrFail($mapTable);
    }
}
