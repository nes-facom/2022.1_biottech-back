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

/**
 * Description of CaixaService
 *
 * @author Leonardo
 */
class CaixaService
{

    public function saveCaixa($data)
    {
        $table = TableRegistry::getTableLocator()->get('Caixa');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);

        if ($table->find('all')->where(['caixa_numero' => $data['caixa_numero']])->first() != null) {
            throw new BadRequestException('Já existe uma Caixa com esse número.');
        }

        try {
            $table->saveOrFail($mapTable, ['atomic' => true]);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function getEntradaDados(): Query
    {
        $table = TableRegistry::getTableLocator()->get('Caixa');


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
            'semanas_na_colonia' => 'FLOOR(DATEDIFF(CURRENT_DATE(), DATE_ADD(nascimento, INTERVAL 21 DAY))/ 7)'
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
        ]);
    }

}
