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
    public function getAllPedidos()
    {

        $findInTable = [
            'LOWER(nome_linha_pesquisa) LIKE' => strtolower("%prod%")
        ];

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
        ]])->where($findInTable);
    }

    public function saveNivelProjetoAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('NivelProjeto');
        $newEmptyTable = $table->newEmptyEntity();

        if(isset($id)){
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            }catch (Exception $e){
                throw new BadRequestException('ID não encontrado.');
            }
        }

        if (!isset($data['nome_nivel_projeto'])) {
            throw new BadRequestException('O Nome do projeto não pode ser nulo.');
        }

        if ($table->find('all')->where(['nome_nivel_projeto' => $data['nome_nivel_projeto']])->first() != null) {
            throw new BadRequestException('Já existe um Nivel Projeto cadastrado com esse nome.');
        }

        return $table->saveOrFail($table->patchEntity($newEmptyTable, $data), ['atomic' => true]);
    }

    public function saveLinhaPesquisaAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('LinhaPesquisa');
        $newEmptyTable = $table->newEmptyEntity();

        if(isset($id)){
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            }catch (Exception $e){
                throw new BadRequestException('ID não encontrado.');
            }
        }

        if (!isset($data['nome_linha_pesquisa'])) {
            throw new BadRequestException('O Nome da Linha de Pesquisa não pode ser nulo.');
        }

        if ($table->find('all')->where(['nome_linha_pesquisa' => $data['nome_linha_pesquisa']])->first() != null) {
            throw new BadRequestException('Já existe uma Linha de Pesquisa cadastrada com esse nome.');
        }

        return $table->saveOrFail($table->patchEntity($newEmptyTable, $data), ['atomic' => true]);
    }

    public function saveFinalidadeAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('Finalidade');
        $newEmptyTable = $table->newEmptyEntity();

        if(isset($id)){
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            }catch (Exception $e){
                throw new BadRequestException('ID não encontrado.');
            }
        }

        if (!isset($data['nome_finalidade'])) {
            throw new BadRequestException('O Nome da Finalidade não pode ser nulo.');
        }

        if ($table->find('all')->where(['nome_finalidade' => $data['nome_finalidade']])->first() != null) {
            throw new BadRequestException('Já existe uma Finalidade cadastrada com esse nome.');
        }

        return $table->saveOrFail($table->patchEntity($newEmptyTable, $data), ['atomic' => true]);
    }

    public function saveLaboratorioAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('Laboratorio');
        $newEmptyTable = $table->newEmptyEntity();

        if(isset($id)){
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            }catch (Exception $e){
                throw new BadRequestException('ID não encontrado.');
            }
        }

        if (!isset($data['nome_laboratorio'])) {
            throw new BadRequestException('O Nome do Laboratório não pode ser nulo.');
        }

        if ($table->find('all')->where(['nome_laboratorio' => $data['nome_laboratorio']])->first() != null) {
            throw new BadRequestException('Já existe um Laboratório  cadastrada com esse nome.');
        }

        return $table->saveOrFail($table->patchEntity($newEmptyTable, $data), ['atomic' => true]);
    }

    public function saveVinculoInstitucionalAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('VinculoInstitucional');
        $newEmptyTable = $table->newEmptyEntity();

        if(isset($id)){
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            }catch (Exception $e){
                throw new BadRequestException('ID não encontrado.');
            }
        }

        if (!isset($data['nome_vinculo_institucional'])) {
            throw new BadRequestException('O Nome do Vínculo Institucional não pode ser nulo.');
        }

        if ($table->find('all')->where(['nome_vinculo_institucional' => $data['nome_vinculo_institucional']])->first() != null) {
            throw new BadRequestException('Já existe um Vinculo Institucional cadastrado com esse nome.');
        }

        return $table->saveOrFail($table->patchEntity($newEmptyTable, $data), ['atomic' => true]);
    }

    public function saveProjetoAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('Projeto');
        $newEmptyTable = $table->newEmptyEntity();

        if(isset($id)){
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            }catch (Exception $e){
                throw new BadRequestException('ID não encontrado.');
            }
        }

        if (!isset($data['nome_projeto'])) {
            throw new BadRequestException('O Nome do Projeto não pode ser nulo.');
        }

        if ($table->find('all')->where(['nome_projeto' => $data['nome_projeto']])->first() != null) {
            throw new BadRequestException('Já existe um Projeto cadastrado com esse nome.');
        }

        return $table->saveOrFail($table->patchEntity($newEmptyTable, $data), ['atomic' => true]);
    }

    public function saveEspecieAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('Especie');
        $newEmptyTable = $table->newEmptyEntity();

        if(isset($id)){
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            }catch (Exception $e){
                throw new BadRequestException('ID não encontrado.');
            }
        }

        if (!isset($data['nome_especie'])) {
            throw new BadRequestException('O Nome da Espécie não pode ser nulo.');
        }

        if ($table->find('all')->where(['nome_especie' => $data['nome_especie']])->first() != null) {
            throw new BadRequestException('Já existe um Projeto cadastrado com esse nome.');
        }

        return $table->saveOrFail($table->patchEntity($newEmptyTable, $data), ['atomic' => true]);
    }

    public function savePedidoAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('Pedido');
        $newEmptyTable = $table->newEmptyEntity();

        if(isset($id)){
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            }catch (Exception $e){
                throw new BadRequestException('ID não encontrado.');
            }
        }

        try {
            return $table->saveOrFail($table->patchEntity($newEmptyTable, $data), ['atomic' => true]);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }
}
