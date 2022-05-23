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

    public function getPedidosTable(PedidoService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('pedidos', $this->paginate($service->getPedidosTable()));
        $this->viewBuilder()->setOption('serialize', ['pedidos']);
    }

    public function addNivelProjeto(PedidoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveNivelProjetoAndUpdate($this->request->getParsedBody(), null));
    }

    public function addLinhaPesquisa(PedidoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveLinhaPesquisaAndUpdate($this->request->getParsedBody(), null));
    }

    public function addFinalidade(PedidoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveFinalidadeAndUpdate($this->request->getParsedBody(), null));
    }

    public function addLaboratorio(PedidoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveLaboratorioAndUpdate($this->request->getParsedBody(), null));
    }

    public function addVinculoInstitucional(PedidoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveVinculoInstitucionalAndUpdate($this->request->getParsedBody(), null));
    }

    public function addProjeto(PedidoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveProjetoAndUpdate($this->request->getParsedBody(), null));
    }

    public function addEspecie(PedidoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveEspecieAndUpdate($this->request->getParsedBody(), null));
    }

    public function addPedido(PedidoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->savePedidoAndUpdate($this->request->getParsedBody(), null));
    }

}
