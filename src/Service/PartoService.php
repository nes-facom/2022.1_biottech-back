<?php


namespace App\Service;

use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

/**
 * Description of PartoService
 *
 * @author Leonardo
 */
class PartoService
{

    public function saveParto($data)
    {
        $table = TableRegistry::getTableLocator()->get('Parto');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);

        $table->saveOrFail($mapTable);

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

}
