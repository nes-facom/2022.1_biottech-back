<?php

namespace App\Service;

use Cake\Http\Exception\BadRequestException;
use Cake\I18n\FrozenTime;
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
        ])->andWhere($findInTable)->andWhere(['TemperaturaUmidade.active' => $active])->order(['created' => 'DESC']);
    }

    public function saveTemperaturaUmidadeAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('TemperaturaUmidade');
        $newEmptyTable = $table->newEmptyEntity();
        $tableSala = TableRegistry::getTableLocator()->get('Sala');

        if (isset($id)) {
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            } catch (Exception $e) {
                throw new BadRequestException('ID não encontrado.');
            }
        } else {
            $newEmptyTable->created = FrozenTime::now();
        }

        if ($data['num_sala']) {
            try {
                $salaId = $tableSala->find('all')->where(['num_sala' => $data['num_sala']])->andWhere(['Sala.active' => true])->firstOrFail();
            } catch (Exception $e) {
                throw new BadRequestException('Sala não encontrada.');
            }
        }

        $newEmptyTable->sala_id = $salaId->id;
        $newEmptyTable->data = $data['data'];
        $newEmptyTable->temp_matutino = $data['temp_matutino'];
        $newEmptyTable->ur_matutino = $data['ur_matutino'];
        $newEmptyTable->temp_vespertino = $data['temp_vespertino'];
        $newEmptyTable->ur_vespertino = $data['ur_vespertino'];
        $newEmptyTable->observacoes = $data['observacoes'];
        $newEmptyTable->modified = FrozenTime::now();

        try {
            return $table->saveOrFail($newEmptyTable, ['atomic' => true]);
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
