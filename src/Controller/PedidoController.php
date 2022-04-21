<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Pedido Controller
 *
 * @property \App\Model\Table\PedidoTable $Pedido
 * @method \App\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PedidoController extends AppController {

    public function initialize(): void {
        parent::initialize();
        $this->loadComponent('BryanCrowe/ApiPagination.ApiPagination');
    }

    public function getAllPedidos() {

        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $responseGetAll = $this->Pedido->getAllPedidos();

            $this->set('pedidos', $this->paginate($responseGetAll));
            $this->viewBuilder()->setOption('serialize', ['pedidos']);

            return;
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }

}
