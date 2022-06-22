<?php

namespace App\Service;

use Cake\Http\Exception\BadRequestException;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Exception;

class TemperaturaUmidadeService
{

    public function getTemperaturaUmidades($search, $year, $active): Query
    {

        $findInTable = [
            'LOWER(concat(".", data, ".",
             IF(temp_matutino=null, temp_matutino , ""), ".",
             IF(ur_matutino=null, ur_matutino , ""), ".",
             IF(temp_vespertino=null, temp_vespertino , ""), ".",
             IF(ur_vespertino=null, ur_vespertino , ""), ".",
             IF(observacoes=null, observacoes , ""), ".")) LIKE' => strtolower("%" . $search . "%")
        ];

        $table = TableRegistry::getTableLocator()->get('TemperaturaUmidade');

        return $table->find()->contain('Sala')->where([
            'YEAR(data)' => $year
        ])->andWhere($findInTable)->andWhere(['TemperaturaUmidade.active' => $active]);
    }

    public function saveTemperaturaUmidadeAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('TemperaturaUmidade');
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
            throw new BadRequestException($e->getMessage());
        }
    }

    public function updateActiveAndDisable($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('TemperaturaUmidade');
        $tableFind = TableRegistry::getTableLocator()->get('TemperaturaUmidade')->find();

        try {
            $temperaturaUmidade = $tableFind->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Saida não encontrado.');
        }

        $temperaturaUmidade->active = $active;

        try {
            return $table->saveOrFail($temperaturaUmidade);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

}
