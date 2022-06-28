<?php


namespace App\Service;

use Cake\Http\Exception\BadRequestException;
use Cake\I18n\FrozenTime;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Exception;

/**
 * Description of PartoService
 *
 * @author Leonardo
 */
class PartoService
{

    public function savePartoAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('Parto');
        $tableCaixaMatriz = TableRegistry::getTableLocator()->get('CaixaMatriz');
        $newEmptyTable = $table->newEmptyEntity();

        if (isset($id)) {
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            } catch (Exception $e) {
                throw new BadRequestException('ID não encontrado.');
            }
        }else {
            $newEmptyTable->created = FrozenTime::now();
        }

        if ($data['caixa_matriz_numero']) {
            try {
                $caixaMatrizId = $tableCaixaMatriz->find('all')->where(['caixa_matriz_numero' => $data['caixa_matriz_numero']])->andWhere(['CaixaMatriz.active' => true])->firstOrFail();
            } catch (Exception $e) {
                throw new BadRequestException('Caixa Matriz não encontrada.');
            }
        }

        $newEmptyTable->caixa_matriz_id = $caixaMatrizId->id;
        $newEmptyTable->numero_parto = $data['numero_parto'];
        $newEmptyTable->data_parto = $data['data_parto'];
        $newEmptyTable->num_macho = $data['num_macho'];
        $newEmptyTable->num_femea = $data['num_femea'];
        $newEmptyTable->des_macho = $data['des_macho'];
        $newEmptyTable->des_femea = $data['des_femea'];
        $newEmptyTable->qtd_canib = $data['qtd_canib'];
        $newEmptyTable->qtd_gamba = $data['qtd_gamba'];
        $newEmptyTable->qtd_outros = $data['qtd_outros'];
        $newEmptyTable->modified = FrozenTime::now();


        try {
            return $table->saveOrFail($newEmptyTable, ['atomic' => true]);
        } catch (Exception $e) {
            throw new BadRequestException($e->getMessage());
        }

    }

    public function getNascDesma($search, $year, $active): Query
    {
        $table = TableRegistry::getTableLocator()->get('Parto');

        $findInTable = [
            'LOWER(concat(".", numero_parto, ".",
             data_parto, ".")) LIKE' => strtolower("%" . $search . "%")
        ];

        return $table->find('all')->select(['id',
            'numero_parto',
            'data_parto',
            'num_macho',
            'num_femea',
            'des_macho',
            'des_femea',
            'qtd_canib',
            'qtd_gamba',
            'qtd_outros',
            'data_desmame' => "DATE_ADD(data_parto, INTERVAL 21 DAY)",
            'total_nascimento' => "num_macho + num_femea",
            'total_desmamado' => "des_macho + des_femea",
            'semana_nascimento' => "WEEK(data_parto, 0)",
            'semana_desmame' => "WEEK(DATE_ADD(data_parto, INTERVAL 21 DAY), 0)"
        ])->contain([
            'CaixaMatriz' => [
                'fields' => [
                    'id',
                    'caixa_matriz_numero',
                    'data_acasalamento',
                    'saida_da_colonia',
                    'data_obito'
                ]
            ]
        ])->where([
            'YEAR(data_parto)' => $year
        ])->andWhere($findInTable)->andWhere(['Parto.active' => $active])->order(['Parto.created' => 'DESC']);
    }

    public function getPartos($search, $year, $active): Query
    {
        $table = TableRegistry::getTableLocator()->get('Parto');

        $findInTable = [
            'LOWER(concat(".", numero_parto, ".",
             data_parto, ".")) LIKE' => strtolower("%" . $search . "%")
        ];

        return $table->find('all')->contain([
            'CaixaMatriz' => [
                'fields' => [
                    'id',
                    'caixa_matriz_numero'
                ]
            ]
        ])->where([
            'YEAR(data_parto)' => $year
        ])->andWhere($findInTable)->andWhere(['Parto.active' => $active])->order(['Parto.created' => 'DESC']);
    }

    public function updateActiveAndDisable($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('Parto');
        $tableFind = TableRegistry::getTableLocator()->get('Parto')->find();

        try {
            $parto = $tableFind->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Parto não encontrado.');
        }

        $parto->active = $active;

        try {
            return $table->saveOrFail($parto);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }
}
