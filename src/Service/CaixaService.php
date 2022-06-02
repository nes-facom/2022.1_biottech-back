<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Service;

use App\Model\Entity\Caixa;
use Cake\Http\Exception\BadRequestException;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Exception;

/**
 * Description of CaixaService
 *
 * @author Leonardo
 */
class CaixaService
{

    public function saveCaixaAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('Caixa');
        $newEmptyTable = $table->newEmptyEntity();

        if (isset($id)) {
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            } catch (Exception $e) {
                throw new BadRequestException('ID não encontrado.');
            }

            if (!!($table->find('all')->where(['id' => $id])->first()->caixa_numero <=> $data['caixa_numero'])) {
                if ($table->find('all')->where(['caixa_numero' => $data['caixa_numero']])->first() != null) {
                    throw new BadRequestException('Já existe uma Caixa com esse número.');
                }
            }

        } else {
            if ($table->find('all')->where(['caixa_numero' => $data['caixa_numero']])->first() != null) {
                throw new BadRequestException('Já existe uma Caixa com esse número.');
            }
        }

        try {
            return $table->saveOrFail($table->patchEntity($newEmptyTable, $data), ['atomic' => true]);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function getEntradaDados($search, $year, $active): Query
    {
        $table = TableRegistry::getTableLocator()->get('Caixa');

        $findInTable = [
            'LOWER(concat(".", caixa_numero, ".",
             nascimento, ".",
             sexo, ".",
             num_animais, ".",
             qtd_saida, ".",
             ultima_saida, ".")) LIKE' => strtolower("%" . $search . "%")
        ];

        return $table->find('all')->select(['id',
            'caixa_numero',
            'nascimento',
            'sexo',
            'num_animais',
            'qtd_saida',
            'ultima_saida',
            'sobra' => 'num_animais - qtd_saida',
            'idade_atual' => 'DATEDIFF(CURRENT_DATE(), nascimento)',
            'ultima_saida_semana' => 'WEEK(ultima_saida, 0)',
            'dias_na_colonia' => 'DATEDIFF(CURRENT_DATE(), DATE_ADD(nascimento, INTERVAL 21 DAY))',
            'semanas_na_colonia' => 'FLOOR(DATEDIFF(CURRENT_DATE(), DATE_ADD(nascimento, INTERVAL 21 DAY))/ 7)',
            'active'
        ])->contain([
            'CaixaMatriz' => [
                'foreignKey' => 'caixa_matriz_id',
                'fields' => [
                    'id',
                    'caixa_matriz_numero',
                ]
            ]
        ])->contain([
            'Linhagem' => [
                'fields' => [
                    'nome_linhagem'
                ]
            ]
        ])->where([
            'YEAR(nascimento)' => $year
        ])->andWhere($findInTable)->andWhere(['Caixa.active' => $active]);
    }

    public function getCaixas($search, $year, $active): Query
    {
        $table = TableRegistry::getTableLocator()->get('Caixa');

        $findInTable = [
            'LOWER(concat(".", Caixa.caixa_numero, ".",
             Caixa.nascimento, ".",
             Caixa.sexo, ".",
             Caixa.ultima_saida, ".")) LIKE' => strtolower("%" . $search . "%")
        ];

        return $table->find('all')->select(['id',
            'caixa_numero',
            'nascimento',
            'sexo',
            'num_animais',
            'qtd_saida',
            'ultima_saida',
            'active'
        ])->contain([
            'Linhagem' => [
                'fields' => [
                    'nome_linhagem'
                ]
            ]
        ])->where([
            'YEAR(nascimento)' => $year
        ])->andWhere($findInTable)->andWhere(['Caixa.active' => $active]);
    }

    public function updateActiveAndDisable($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('Caixa');
        $tableFind = TableRegistry::getTableLocator()->get('Caixa')->find();

        try {
            $caixa = $tableFind->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Caixa não encontrado.');
        }

        $caixa->active = $active;

        try {
            return $table->saveOrFail($caixa);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

}
