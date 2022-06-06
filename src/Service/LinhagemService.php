<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Service;

use Cake\Http\Exception\BadRequestException;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Exception;

/**
 * Description of LinhagemService
 *
 * @author Leonardo
 */
class LinhagemService
{

    public function saveLinhagemAndUpdate($data, $id)
    {
        $table = TableRegistry::getTableLocator()->get('Linhagem');
        $newEmptyTable = $table->newEmptyEntity();

        if(isset($id)){
            try {
                $newEmptyTable = $table->find()->where(['id' => $id])->where()->firstOrFail();
            }catch (Exception $e){
                throw new BadRequestException('ID não encontrado.');
            }
        }

        if (!isset($data['nome_linhagem'])) {
            throw new BadRequestException('O Nome da Linhagem não pode ser nulo.');
        }

        if ($table->find('all')->where(['nome_linhagem' => $data['nome_linhagem']])->first() != null) {
            throw new BadRequestException('Já existe uma Linhagem com esse nome.');
        }

        return $table->saveOrFail($table->patchEntity($newEmptyTable , $data), ['atomic' => true]);
    }

    public function getLinhagens($search, $active): Query
    {
        $findInTable = [
            'LOWER(concat(".", nome_linhagem, ".")) LIKE' => strtolower("%" . $search . "%")
        ];

        $table = TableRegistry::getTableLocator()->get('Linhagem')->find('all')->where($findInTable)->andWhere(['active' => $active]);;

        return $table->find('all');
    }

    public function updateActiveAndDisable($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('Linhagem');
        $tableFind = TableRegistry::getTableLocator()->get('Linhagem')->find();

        try {
            $linhagem = $tableFind->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Linhagem não encontrado.');
        }

        $linhagem->active = $active;

        try {
            return $table->saveOrFail($linhagem);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }
}
