<?php

namespace App\Service;

use Cake\ORM\TableRegistry;

class PedidoService {

    public function getAllPedidos() {

        // Prior to 3.6 use TableRegistry::get('Articles')
        $pedidoTable = TableRegistry::getTableLocator()->get('Pedido')->find();

        //$queryUser = $usersTable->all();


        $query = $pedidoTable->find('all', ['contain' => ['VinculoInstitucional', 'Projeto', 'Especie', 'LinhaPesquisa'
                , 'NivelProjeto', 'Laboratorio', 'Finalidade', 'Pesquisador', 'Linhagem', 'Previsao']]);

        foreach ($query as $row) {

            $row->{"saldoCEUA"} = ($row->num_aprovado - $row->num_solicitado) + $row->adendo_1 + $row->adendo_2;
        }
        //$query = $pedidoTable->find('all');
        //$query =   $pedidoTable->all();

        /* $query = $usersTable->all()->contains([
          'Pesquisador'
          ]); */


        return $query;
    }

    public function saveNivelProjeto($data) {
        $table = \Cake\ORM\TableRegistry::getTableLocator()->get('NivelProjeto');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable= $table->patchEntity($newEmptyTable, $data);

        $saveObject = $table->save($mapTable);

        return $saveObject;
    }

    public function saveLinhaPesquisa($data) {
        $table = \Cake\ORM\TableRegistry::getTableLocator()->get('LinhaPesquisa');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable= $table->patchEntity($newEmptyTable, $data);

        $saveObject = $table->save($mapTable);

        return $saveObject;
    }

    public function saveFinalidade($data) {
        $table = \Cake\ORM\TableRegistry::getTableLocator()->get('Finalidade');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable= $table->patchEntity($newEmptyTable, $data);

        $saveObject = $table->save($mapTable);

        return $saveObject;
    }

    public function saveLaboratorio($data) {
        $table = \Cake\ORM\TableRegistry::getTableLocator()->get('Laboratorio');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable= $table->patchEntity($newEmptyTable, $data);

        $saveObject = $table->save($mapTable);

        return $saveObject;
    }
    
     public function saveVinculoInstitucional($data) {
        $table = \Cake\ORM\TableRegistry::getTableLocator()->get('VinculoInstitucional');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable= $table->patchEntity($newEmptyTable, $data);

        $saveObject = $table->save($mapTable);

        return $saveObject;
    }
    
    public function saveProjeto($data) {
        $table = \Cake\ORM\TableRegistry::getTableLocator()->get('Projeto');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable= $table->patchEntity($newEmptyTable, $data);

        $saveObject = $table->save($mapTable);

        return $saveObject;
    }
    
     public function saveEspecie($data) {
        $table = \Cake\ORM\TableRegistry::getTableLocator()->get('Especie');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable= $table->patchEntity($newEmptyTable, $data);

        $saveObject = $table->save($mapTable);

        return $saveObject;
    }
    
    public function savePedido($data) {
        $table = \Cake\ORM\TableRegistry::getTableLocator()->get('Pedido');
        $newEmptyTable = $table->newEmptyEntity();
        
        var_dump($newEmptyTable);
        die();

        $mapTable= $table->patchEntity($newEmptyTable, $data);

        $saveObject = $table->save($mapTable);

        return $saveObject;
    }

}
