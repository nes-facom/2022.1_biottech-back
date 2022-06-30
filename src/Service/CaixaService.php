<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Service;

use App\Model\Entity\Caixa;
use Cake\Http\Exception\BadRequestException;
use Cake\I18n\FrozenTime;
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
        $tableCaixaMatriz = TableRegistry::getTableLocator()->get('CaixaMatriz');
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
            $newEmptyTable->created = FrozenTime::now();
        }

        if (!empty($data['caixa_matriz_numero'])) {
            try {
                $caixaMatrizId = $tableCaixaMatriz->find('all')->where(['caixa_matriz_numero' => $data['caixa_matriz_numero']])->andWhere(['CaixaMatriz.active' => true])->firstOrFail();
                $newEmptyTable->caixa_matriz_id = $caixaMatrizId->id;
            } catch (Exception $e) {
                throw new BadRequestException('Caixa Matriz não encontrada.');
            }
        }

        $newEmptyTable->linhagem_id = $data['linhagem_id'];
        $newEmptyTable->caixa_numero = $data['caixa_numero'];
        $newEmptyTable->nascimento = $data['nascimento'];
        $newEmptyTable->sexo = $data['sexo'];
        $newEmptyTable->num_animais = $data['num_animais'];
        $newEmptyTable->qtd_saida = $data['qtd_saida'];
        $newEmptyTable->ultima_saida = $data['ultima_saida'];
        $newEmptyTable->modified = FrozenTime::now();

        try {
            return $table->saveOrFail( $newEmptyTable, ['atomic' => true]);
        } catch (Exception $e) {
            throw new BadRequestException($e->getMessage());
        }
    }

    public function getEntradaDados($search, $year, $active): Query
    {
        $table = TableRegistry::getTableLocator()->get('Caixa');

        $findInTable = [
            'LOWER(concat(".", Caixa.caixa_numero, ".",
             Caixa.nascimento, ".",
             Caixa.sexo, ".",
             Caixa.num_animais, ".",
             IF(Caixa.qtd_saida=null, Caixa.qtd_saida , ""), ".",
             IF(Caixa.ultima_saida=null, Caixa.ultima_saida , ""), ".")) LIKE' => strtolower("%" . $search . "%")
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
            'dias_na_colonia' =>'IF(DATEDIFF(CURRENT_DATE(), DATE_ADD(nascimento, INTERVAL 21 DAY))<0, 0 , DATEDIFF(CURRENT_DATE(), DATE_ADD(nascimento, INTERVAL 21 DAY)))',
            'semanas_na_colonia' => 'IF(FLOOR(DATEDIFF(CURRENT_DATE(), DATE_ADD(nascimento, INTERVAL 21 DAY))/ 7)<0, 0 , FLOOR(DATEDIFF(CURRENT_DATE(), DATE_ADD(nascimento, INTERVAL 21 DAY))/ 7))',
            'active'
        ])->contain([
            'CaixaMatriz' => [
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
        ])->andWhere($findInTable)->andWhere(['Caixa.active' => $active])->order(['Caixa.created' => 'DESC']);
    }

    public function getCaixas($search, $year, $active): Query
    {
        $table = TableRegistry::getTableLocator()->get('Caixa');

        $findInTable = [
            'LOWER(concat(".", Caixa.caixa_numero, ".",
             Caixa.nascimento, ".",
             Caixa.sexo, ".",
             IF(Caixa.ultima_saida=null, Caixa.ultima_saida , "") , ".")) LIKE' => strtolower("%" . $search . "%")
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
                    'id',
                    'nome_linhagem'
                ]
            ]
        ])->contain([
            'CaixaMatriz' => [
                'fields' => [
                    'id',
                    'caixa_matriz_numero',
                ]
            ]
        ])->where([
            'YEAR(nascimento)' => $year
        ])->andWhere($findInTable)->andWhere(['Caixa.active' => $active])->order(['Caixa.created' => 'DESC']);
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
