<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\PedidoService;

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

    public function getAllPedidos(PedidoService $service) {

        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $responseGetAll = $service->getAllPedidos();
            
            

            //paginação
            /* $this->set('pedidos', $this->paginate($responseGetAll));
              $this->viewBuilder()->setOption('serialize', ['pedidos']);

              return; */

            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode($responseGetAll));

            return $response;
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }
    
     public function addNivelProjeto(PedidoService $service) {

         //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveNivelProjeto($data);
            

            if ($newSave) {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(201)
                        ->withStringBody(json_encode($newSave));
                return $response;
            } else {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(400)
                        ->withStringBody(json_encode([]));
                return $response;
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }
    
    public function addLinhaPesquisa(PedidoService $service) {

         //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveLinhaPesquisa($data);
            

            if ($newSave) {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(201)
                        ->withStringBody(json_encode($newSave));
                return $response;
            } else {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(400)
                        ->withStringBody(json_encode([]));
                return $response;
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }
    
    public function addFinalidade(PedidoService $service) {

         //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveFinalidade($data);
            

            if ($newSave) {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(201)
                        ->withStringBody(json_encode($newSave));
                return $response;
            } else {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(400)
                        ->withStringBody(json_encode([]));
                return $response;
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }
    
     public function addLaboratorio(PedidoService $service) {

         //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveLaboratorio($data);
            

            if ($newSave) {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(201)
                        ->withStringBody(json_encode($newSave));
                return $response;
            } else {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(400)
                        ->withStringBody(json_encode([]));
                return $response;
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }
    
    public function addVinculoInstitucional(PedidoService $service) {

         //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveVinculoInstitucional($data);
            

            if ($newSave) {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(201)
                        ->withStringBody(json_encode($newSave));
                return $response;
            } else {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(400)
                        ->withStringBody(json_encode([]));
                return $response;
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }
    
    public function addProjeto(PedidoService $service) {

         //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveProjeto($data);
            

            if ($newSave) {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(201)
                        ->withStringBody(json_encode($newSave));
                return $response;
            } else {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(400)
                        ->withStringBody(json_encode([]));
                return $response;
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }
    
    public function addEspecie(PedidoService $service) {

         //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveEspecie($data);
            

            if ($newSave) {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(201)
                        ->withStringBody(json_encode($newSave));
                return $response;
            } else {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(400)
                        ->withStringBody(json_encode([]));
                return $response;
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }
    
    public function addPedido(PedidoService $service) {

         //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->savePedido($data);
            

            if ($newSave) {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(201)
                        ->withStringBody(json_encode($newSave));
                return $response;
            } else {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(400)
                        ->withStringBody(json_encode([]));
                return $response;
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }
    
    

}
