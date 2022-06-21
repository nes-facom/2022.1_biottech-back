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
    public function getPedidosTable($search, $year, $active)
    {

        $findInTable = [
            'LOWER(concat(".", equipe_executora, ".",
             processo_sei, ".",
             IF(equipe_executora=null, equipe_executora , ""), ".",
             data_solicitacao, ".",
             titulo, ".",
             IF(especificar=null, especificar , ""), ".",
             exper, ".",
             num_ceua, ".",
             vigencia_ceua, ".",
             num_aprovado, ".",
             num_solicitado, ".",
             IF(adendo_1=null, adendo_1 , ""), ".",
             IF(adendo_2=null, adendo_2 , ""), ".",
             sexo, ".",
             IF(idade=null, idade , ""), ".",
             IF(peso=null, peso , ""), ".",
             IF(observacoes=null, observacoes , ""), ".")) LIKE' => strtolower("%" . $search . "%")
        ];

        $pedidoTable = TableRegistry::getTableLocator()->get('Pedido');

        $previsaoTable = TableRegistry::getTableLocator()->get('Previsao')->find();

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
            'active'
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
        ]])->where([
            'YEAR(data_solicitacao)' => $year
        ])->andWhere($findInTable)->andWhere(['Pedido.active' => $active]);
    }

    public function getPedidos($search, $year, $active)
    {

        $findInTable = [
            'LOWER(concat(".", equipe_executora, ".",
             processo_sei, ".",
             IF(equipe_executora=null, equipe_executora , ""), ".",
             data_solicitacao, ".",
             titulo, ".",
             IF(especificar=null, especificar , ""), ".",
             exper, ".",
             num_ceua, ".",
             vigencia_ceua, ".",
             num_aprovado, ".",
             num_solicitado, ".",
             IF(adendo_1=null, adendo_1 , ""), ".",
             IF(adendo_2=null, adendo_2 , ""), ".",
             sexo, ".",
             IF(idade=null, idade , ""), ".",
             IF(peso=null, peso , ""), ".",
             IF(observacoes=null, observacoes , ""), ".")) LIKE' => strtolower("%" . $search . "%")

        ];

        $pedidoTable = TableRegistry::getTableLocator()->get('Pedido');

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
            'active'
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
                'retirada_data'
            ]
        ]])->where([
            'YEAR(data_solicitacao)' => $year
        ])->andWhere($findInTable)->andWhere(['Pedido.active' => $active]);
    }

    public function saveNivelProjetoAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('NivelProjeto');
        $newEmptyTable = $table->newEmptyEntity();

        if (isset($id)) {
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            } catch (Exception $e) {
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

    public function updateActiveAndDisableNivelProjeto($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('NivelProjeto');
        $tableFind = TableRegistry::getTableLocator()->get('NivelProjeto')->find();

        try {
            $nivelProjeto = $tableFind->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Nivel Projeto não encontrado.');
        }

        $nivelProjeto->active = $active;

        try {
            return $table->saveOrFail($nivelProjeto);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function getNivelProjetos($active): Query
    {
        $table = TableRegistry::getTableLocator()->get('NivelProjeto');

        return $table->find('all')->select(['id', 'nome_nivel_projeto'])->where(['active' => $active]);
    }

    public function saveLinhaPesquisaAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('LinhaPesquisa');
        $newEmptyTable = $table->newEmptyEntity();

        if (isset($id)) {
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            } catch (Exception $e) {
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

    public function updateActiveAndDisableLinhaPesquisa($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('LinhaPesquisa');
        $tableFind = TableRegistry::getTableLocator()->get('LinhaPesquisa')->find();

        try {
            $linhaPesquisa = $tableFind->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Linha Pesquisa não encontrada.');
        }

        $linhaPesquisa->active = $active;

        try {
            return $table->saveOrFail($linhaPesquisa);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function getLinhaPesquisas($active): Query
    {
        $table = TableRegistry::getTableLocator()->get('LinhaPesquisa');

        return $table->find('all')->select(['id', 'nome_linha_pesquisa'])->where(['active' => $active]);
    }

    public function saveFinalidadeAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('Finalidade');
        $newEmptyTable = $table->newEmptyEntity();

        if (isset($id)) {
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            } catch (Exception $e) {
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

    public function updateActiveAndDisableFinalidade($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('Finalidade');
        $tableFind = TableRegistry::getTableLocator()->get('Finalidade')->find();

        try {
            $finalidade = $tableFind->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Finalidade não encontrada.');
        }

        $finalidade->active = $active;

        try {
            return $table->saveOrFail($finalidade);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function getFinalidades($active): Query
    {
        $table = TableRegistry::getTableLocator()->get('Finalidade');

        return $table->find('all')->select(['id', 'nome_finalidade'])->where(['active' => $active]);
    }

    public function saveLaboratorioAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('Laboratorio');
        $newEmptyTable = $table->newEmptyEntity();

        if (isset($id)) {
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            } catch (Exception $e) {
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

    public function updateActiveAndDisableLaboratorio($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('Laboratorio');
        $tableFind = TableRegistry::getTableLocator()->get('Laboratorio')->find();

        try {
            $laboratorio = $tableFind->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Laboratorio não encontrada.');
        }

        $laboratorio->active = $active;

        try {
            return $table->saveOrFail($laboratorio);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function getLaboratorios($active): Query
    {
        $table = TableRegistry::getTableLocator()->get('Laboratorio');

        return $table->find('all')->select(['id', 'nome_laboratorio'])->where(['active' => $active]);
    }

    public function saveVinculoInstitucionalAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('VinculoInstitucional');
        $newEmptyTable = $table->newEmptyEntity();

        if (isset($id)) {
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            } catch (Exception $e) {
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

    public function updateActiveAndDisableVinculoInstitucional($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('VinculoInstitucional');
        $tableFind = TableRegistry::getTableLocator()->get('VinculoInstitucional')->find();

        try {
            $vinculoInstitucional = $tableFind->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Vinculo Institucional não encontrado.');
        }

        $vinculoInstitucional->active = $active;

        try {
            return $table->saveOrFail($vinculoInstitucional);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function getVinculoInstitucionais($active): Query
    {
        $table = TableRegistry::getTableLocator()->get('VinculoInstitucional');

        return $table->find('all')->select(['id', 'nome_vinculo_institucional'])->where(['active' => $active]);
    }

    public function saveProjetoAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('Projeto');
        $newEmptyTable = $table->newEmptyEntity();

        if (isset($id)) {
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            } catch (Exception $e) {
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

    public function updateActiveAndDisableProjeto($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('Projeto');
        $tableFind = TableRegistry::getTableLocator()->get('Projeto')->find();

        try {
            $projeto = $tableFind->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Projeto não encontrado.');
        }

        $projeto->active = $active;

        try {
            return $table->saveOrFail($projeto);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function getProjetos($active): Query
    {
        $table = TableRegistry::getTableLocator()->get('Projeto');

        return $table->find('all')->select(['id', 'nome_projeto'])->where(['active' => $active]);
    }

    public function saveEspecieAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('Especie');
        $newEmptyTable = $table->newEmptyEntity();

        if (isset($id)) {
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            } catch (Exception $e) {
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

    public function updateActiveAndDisableEspecie($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('Especie');
        $tableFind = TableRegistry::getTableLocator()->get('Especie')->find();

        try {
            $especie = $tableFind->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Especie não encontrada.');
        }

        $especie->active = $active;

        try {
            return $table->saveOrFail($especie);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function getEspecies($active): Query
    {
        $table = TableRegistry::getTableLocator()->get('Especie');

        return $table->find('all')->select(['id', 'nome_especie'])->where(['active' => $active]);
    }

    public function savePedidoAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('Pedido');
        $newEmptyTable = $table->newEmptyEntity();

        if (isset($id)) {
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            } catch (Exception $e) {
                throw new BadRequestException('ID não encontrado.');
            }
        }

        try {
            return $table->saveOrFail($table->patchEntity($newEmptyTable, $data), ['atomic' => true]);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }


    public function updateActiveAndDisablePedido($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('Pedido');
        $tableFind = TableRegistry::getTableLocator()->get('Pedido')->find();

        try {
            $pedido = $tableFind->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Pedido não encontrado.');
        }

        $pedido->active = $active;

        try {
            return $table->saveOrFail($pedido);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }
}
