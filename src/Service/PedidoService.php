<?php

namespace App\Service;

use Cake\Http\Exception\BadRequestException;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Exception;

class PedidoService
{

    /**
     * By default all the associations on this table will be hydrated. You can
     * limit which associations are built, or include deeper associations
     * using the options parameter:
     * @return Query
     * @throws \Exception
     */
    public function getAllPedidos(): Query
    {
        $pedidoTable = TableRegistry::getTableLocator()->get('Pedido');

        $previsaoTable = TableRegistry::getTableLocator()->get('Previsao')->find();

        /*$query = $pedidoTable->find('all', ['contain' => ['VinculoInstitucional', 'Projeto', 'Especie', 'LinhaPesquisa'
            , 'NivelProjeto', 'Laboratorio', 'Finalidade', 'Pesquisador', 'Linhagem', 'Previsao']]);*/

        return $pedidoTable->find('all')->select(['id',
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
    }

    public function saveNivelProjeto($data)
    {

        $table = TableRegistry::getTableLocator()->get('NivelProjeto');
        $newEmptyTable = $table->newEmptyEntity();

        if ($table->find('all')->where(['nome_nivel_projeto' => $data['nome_nivel_projeto']])->first() != null) {
            throw new BadRequestException('Já existe um Nivel Projeto cadastrado com esse nome.');
        }

        try {
            $mapTable = $table->patchEntity($newEmptyTable, $data);

            $saveObject = $table->saveOrFail($mapTable, ['atomic' => true]);

            return $saveObject;

        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function saveLinhaPesquisa($data)
    {
        $table = TableRegistry::getTableLocator()->get('LinhaPesquisa');
        $newEmptyTable = $table->newEmptyEntity();

        if ($table->find('all')->where(['nome_linha_pesquisa' => $data['nome_linha_pesquisa']])->first() != null) {
            throw new BadRequestException('Já existe uma Linha de Pesquisa cadastrada com esse nome.');
        }

        try {

            $mapTable = $table->patchEntity($newEmptyTable, $data);

            $saveObject = $table->saveOrFail($mapTable, ['atomic' => true]);

            return $saveObject;

        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function saveFinalidade($data)
    {
        $table = TableRegistry::getTableLocator()->get('Finalidade');
        $newEmptyTable = $table->newEmptyEntity();


        if ($table->find('all')->where(['nome_finalidade' => $data['nome_finalidade']])->first() != null) {
            throw new BadRequestException('Já existe uma Finalidade cadastrada com esse nome.');
        }

        try {

            $mapTable = $table->patchEntity($newEmptyTable, $data);

            $saveObject = $table->saveOrFail($mapTable, ['atomic' => true]);

            return $saveObject;

        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function saveLaboratorio($data)
    {

        $table = TableRegistry::getTableLocator()->get('Laboratorio');
        $newEmptyTable = $table->newEmptyEntity();

        if ($table->find('all')->where(['nome_laboratorio' => $data['nome_laboratorio']])->first() != null) {
            throw new BadRequestException('Já existe um Laboratório  cadastrada com esse nome.');
        }

        try {
            $mapTable = $table->patchEntity($newEmptyTable, $data);

            $saveObject = $table->saveOrFail($mapTable, ['atomic' => true]);

            return $saveObject;
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function saveVinculoInstitucional($data)
    {

        $table = TableRegistry::getTableLocator()->get('VinculoInstitucional');
        $newEmptyTable = $table->newEmptyEntity();

        if ($table->find('all')->where(['nome_vinculo_institucional' => $data['nome_vinculo_institucional']])->first() != null) {
            throw new BadRequestException('Já existe um Vinculo Institucional cadastrado com esse nome.');
        }

        try {

            $mapTable = $table->patchEntity($newEmptyTable, $data);

            $saveObject = $table->saveOrFail($mapTable, ['atomic' => true]);

            return $saveObject;

        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function saveProjeto($data)
    {
        $table = TableRegistry::getTableLocator()->get('Projeto');
        $newEmptyTable = $table->newEmptyEntity();

        if ($table->find('all')->where(['nome_projeto' => $data['nome_projeto']])->first() != null) {
            throw new BadRequestException('Já existe um Projeto cadastrado com esse nome.');
        }

        try {

            $mapTable = $table->patchEntity($newEmptyTable, $data);

            $saveObject = $table->saveOrFail($mapTable, ['atomic' => true]);

            return $saveObject;

        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function saveEspecie($data)
    {
        $table = TableRegistry::getTableLocator()->get('Especie');
        $newEmptyTable = $table->newEmptyEntity();

        if ($table->find('all')->where(['nome_especie' => $data['nome_especie']])->first() != null) {
            throw new BadRequestException('Já existe um Projeto cadastrado com esse nome.');
        }

        try {

            $mapTable = $table->patchEntity($newEmptyTable, $data);

            $saveObject = $table->saveOrFail($mapTable, ['atomic' => true]);

            return $saveObject;

        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function savePedido($data)
    {
        $table = TableRegistry::getTableLocator()->get('Pedido');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);

        try {
            $table->saveOrFail($mapTable, ['atomic' => true]);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }

    }
}
