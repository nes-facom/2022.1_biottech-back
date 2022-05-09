<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Service;

use Cake\Http\Exception\BadRequestException;
use Cake\ORM\TableRegistry;

/**
 * Description of LinhagemService
 *
 * @author Leonardo
 */
class LinhagemService
{

    public function saveLinhagem($data)
    {
        $table = TableRegistry::getTableLocator()->get('Linhagem');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);

        if ($table->find('all')->where(['nome_linhagem' => $data['nome_linhagem']])->first() != null) {
            throw new BadRequestException('Já existe uma Linhagem com esse nome.');
        }
        try {
            return $table->saveOrFail($mapTable, ['atomic' => true]);

        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }
}
