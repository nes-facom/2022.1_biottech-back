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

            return $this->Util->convertToJson(200, $responseGetAll);
        } else {
            return $this->Util->convertToJson(401, []);
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
                return $this->Util->convertToJson(201, $newSave);
            } else {
                return $this->Util->convertToJson(400, []);
            }
        } else {
            return $this->Util->convertToJson(401, []);
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
                return $this->Util->convertToJson(201, $newSave);
            } else {
                return $this->Util->convertToJson(400, []);
            }
        } else {
            return $this->Util->convertToJson(401, []);
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
                return $this->Util->convertToJson(201, $newSave);
            } else {
                return $this->Util->convertToJson(400, []);
            }
        } else {
            return $this->Util->convertToJson(401, []);
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
                return $this->Util->convertToJson(201, $newSave);
            } else {
                return $this->Util->convertToJson(400, []);
            }
        } else {
            return $this->Util->convertToJson(401, []);
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
                return $this->Util->convertToJson(201, $newSave);
            } else {
                return $this->Util->convertToJson(400, []);
            }
        } else {
            return $this->Util->convertToJson(401, []);
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
                return $this->Util->convertToJson(201, $newSave);
            } else {
                return $this->Util->convertToJson(400, []);
            }
        } else {
            return $this->Util->convertToJson(401, []);
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
                return $this->Util->convertToJson(201, $newSave);
            } else {
                return $this->Util->convertToJson(400, []);
            }
        } else {
            return $this->Util->convertToJson(401, []);
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
                return $this->Util->convertToJson(201, []);
            } else {
                return $this->Util->convertToJson(400, []);
            }
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

}
