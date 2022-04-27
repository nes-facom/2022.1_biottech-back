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

}
