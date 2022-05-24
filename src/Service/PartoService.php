<?php


namespace App\Service;

use Cake\Http\Exception\BadRequestException;
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
        $newEmptyTable = $table->newEmptyEntity();

        if(isset($id)){
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            }catch (Exception $e){
                throw new BadRequestException('ID não encontrado.');
            }
        }

        if ($table->find('all')->where(['numero_parto' => $data['numero_parto']])->first() != null) {
            throw new BadRequestException('Já existe um Parto cadastrado com esse número.');
        }

        try {
            return $table->saveOrFail($table->patchEntity($newEmptyTable, $data), ['atomic' => true]);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }

    }

    public function getNascDesma(): Query
    {
        $table = TableRegistry::getTableLocator()->get('Parto');

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
        ]);
    }

    public function getPartos(): Query
    {
        $table = TableRegistry::getTableLocator()->get('Parto');

        return $table->find('all');
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
