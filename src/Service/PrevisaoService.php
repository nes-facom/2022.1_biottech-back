<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Service;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

/**
 * Description of PrevisaoService
 *
 * @author Leonardo
 */
class PrevisaoService
{

    public function savePrevisao($data)
    {
        $table = TableRegistry::getTableLocator()->get('Previsao');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);

        $table->saveOrFail($mapTable);
    }

    public function getPrevisao(): Query
    {
        $table = TableRegistry::getTableLocator()->get('Previsao');
        $saidaTable = TableRegistry::getTableLocator()->get('Saida')->find();

        //return $table->find('all')->contain(['Pesquisador']);

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
        ]);

    }

}
