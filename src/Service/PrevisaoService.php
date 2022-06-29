<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Service;

use Cake\Http\Exception\BadRequestException;
use Cake\I18n\FrozenTime;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Exception;

/**
 * Description of PrevisaoService
 *
 * @author Leonardo
 */
class PrevisaoService
{

    public function savePrevisaoAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('Previsao');
        $newEmptyTable = $table->newEmptyEntity();


        if (isset($id)) {
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            } catch (Exception $e) {
                throw new BadRequestException('ID não encontrado.');
            }

            if ($table->find('all')->where(['id' => $id])->first()->num_previsao != $data['num_previsao']) {
                if ($table->find('all')->where(['num_previsao' => $data['num_previsao']])->first() != null) {
                    throw new BadRequestException('Já existe uma Previsão com esse número.');
                }
            }

        } else {
            if ($table->find('all')->where(['num_previsao' => $data['num_previsao']])->first() != null) {
                throw new BadRequestException('Já existe uma Previsão com esse número.');
            }
            $newEmptyTable->created = FrozenTime::now();
        }

        $newEmptyTable->modified = FrozenTime::now();

        try {
            return $table->saveOrFail($table->patchEntity($newEmptyTable, $data), ['atomic' => true]);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function getPrevisao($search, $year, $active): Query
    {
        $table = TableRegistry::getTableLocator()->get('Previsao');
        $saidaTable = TableRegistry::getTableLocator()->get('Saida')->find();

        $findInTable = [
            'LOWER(concat(".", num_previsao, ".",
             retirada_num, ".",
             retirada_data, ".",
             status, ".")) LIKE' => strtolower("%" . $search . "%")
        ];

        return $table->find('all')->select(['id',
            'pedido_id',
            'num_previsao',
            'retirada_num',
            'qtd_retirar',
            'retirada_data',
            'status',
            'totalRetirado',
            'retirada' => 'num_previsao - retirada_num',
            'retirada_semana' => "WEEK(retirada_data, 0)",
            'ano' => 'YEAR(retirada_data)',
            'mes' => 'MONTH(retirada_data)',
            'semestre' => "IF(MONTH(retirada_data) < 7, 1, 2)"
        ])->contain([
            'Saida' => [
                'fields' => [
                    'num_animais',
                    'retirado' => $saidaTable->func()->sum('num_animais')
                ]
            ]
        ])->contain([
            'Pedido' => [
                'fields' => [
                    'id',
                    'sexo',
                    'idade',
                    'peso',
                    'exper'
                ],
                'Projeto' => [
                    'fields' => [
                        'nome_projeto'
                    ]
                ],
                'Finalidade' => [
                    'fields' => [
                        'nome_finalidade'
                    ]
                ],
                'Pesquisador' => [
                    'fields' => [
                        'nome',
                        'setor',
                        'instituicao',
                        'pos'
                    ]
                ],
                'Linhagem' => [
                    'fields' => [
                        'nome_linhagem'
                    ]
                ]
            ]
        ])->where([
            'YEAR(retirada_data)' => $year
        ])->andWhere($findInTable)->andWhere(['Previsao.active' => $active])->order(['Previsao.created' => 'DESC']);
    }

    public function getPrevisoes($search, $year, $active): Query
    {
        $table = TableRegistry::getTableLocator()->get('Previsao');

        $findInTable = [
            'LOWER(concat(".", num_previsao, ".",
             retirada_num, ".",
             retirada_data, ".",
             status, ".")) LIKE' => strtolower("%" . $search . "%")
        ];

        return $table->find()->where([
            'YEAR(retirada_data)' => $year
        ])->andWhere($findInTable)->andWhere(['Previsao.active' => $active])->order(['Previsao.created' => 'DESC']);
    }

    public function updateActiveAndDisable($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('Previsao');
        $tableFind = TableRegistry::getTableLocator()->get('Previsao')->find();

        try {
            $previsao = $tableFind->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Pesquisador não encontrado.');
        }

        $previsao->active = $active;

        try {
            return $table->saveOrFail($previsao);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

}
