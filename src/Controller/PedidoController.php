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
class PedidoController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('BryanCrowe/ApiPagination.ApiPagination');
    }

    public function getAllPedidos(PedidoService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $responseGetAll = $service->getAllPedidos();

            //return $this->Util->convertToJson(200, $responseGetAll);
            $this->set('pedidos', $this->paginate($responseGetAll));
            $this->viewBuilder()->setOption('serialize', ['pedidos']);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function addNivelProjeto(PedidoService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveNivelProjetoAndUpdate($data);

            return $this->Util->convertToJson(201, $newSave);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function addLinhaPesquisa(PedidoService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveLinhaPesquisaAndUpdate($data);


            return $this->Util->convertToJson(201, $newSave);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function addFinalidade(PedidoService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveFinalidadeAndUpdate($data);

            return $this->Util->convertToJson(201, $newSave);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function addLaboratorio(PedidoService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveLaboratorioAndUpdate($data);

            return $this->Util->convertToJson(201, $newSave);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function addVinculoInstitucional(PedidoService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveVinculoInstitucionalAndUpdate($data);

            return $this->Util->convertToJson(201, $newSave);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function addProjeto(PedidoService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveProjetoAndUpdate($data);

            return $this->Util->convertToJson(201, $newSave);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function addEspecie(PedidoService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveEspecieAndUpdate($data);

            return $this->Util->convertToJson(201, $newSave);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function addPedido(PedidoService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->savePedidoAndUpdate($data);

            return $this->Util->convertToJson(201, $newSave);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

}
