<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Service;

use Cake\Http\Exception\BadRequestException;
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
}
