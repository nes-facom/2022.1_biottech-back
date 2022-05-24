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

        $this->set('pedidos', $this->paginate($service->getPedidosTable($this->request->getQuery('search'), $this->request->getQuery('year'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['pedidos']);
    }

    public function getPedidos(PedidoService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('pedidos', $this->paginate($service->getPedidos($this->request->getQuery('search'), $this->request->getQuery('year'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['pedidos']);
    }


    public function getNivelProjetos(PedidoService $service)
    {
        $this->request->allowMethod(['get']);

        return $this->Util->convertToJson(200, $service->getNivelProjetos(filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }

    public function addNivelProjeto(PedidoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveNivelProjetoAndUpdate($this->request->getParsedBody(), null));
    }

    public function getLinhaPesquisas(PedidoService $service)
    {
        $this->request->allowMethod(['get']);

        return $this->Util->convertToJson(200, $service->getLinhaPesquisas(filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }

    public function addLinhaPesquisa(PedidoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveLinhaPesquisaAndUpdate($this->request->getParsedBody(), null));
    }

    public function getFinalidades(PedidoService $service)
    {
        $this->request->allowMethod(['get']);

        return $this->Util->convertToJson(200, $service->getFinalidades(filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }

    public function addFinalidade(PedidoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveFinalidadeAndUpdate($this->request->getParsedBody(), null));
    }

    public function getLaboratorios(PedidoService $service)
    {
        $this->request->allowMethod(['get']);

        return $this->Util->convertToJson(200, $service->getLaboratorios(filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }

    public function addLaboratorio(PedidoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveLaboratorioAndUpdate($this->request->getParsedBody(), null));
    }

    public function getVinculoInstitucionais(PedidoService $service)
    {
        $this->request->allowMethod(['get']);

        return $this->Util->convertToJson(200, $service->getVinculoInstitucionais(filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }

    public function addVinculoInstitucional(PedidoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveVinculoInstitucionalAndUpdate($this->request->getParsedBody(), null));
    }

    public function getProjetos(PedidoService $service)
    {
        $this->request->allowMethod(['get']);

        return $this->Util->convertToJson(200, $service->getProjetos(filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }

    public function addProjeto(PedidoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveProjetoAndUpdate($this->request->getParsedBody(), null));
    }

    public function getEspecies(PedidoService $service)
    {
        $this->request->allowMethod(['get']);

        return $this->Util->convertToJson(200, $service->getEspecies(filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
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

    public function activeAndDisable(PedidoService $service)
    {
        $this->request->allowMethod(['delete']);

        return $this->Util->convertToJson(200, $service->updateActiveAndDisable($this->request->getQuery('id'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }

}
