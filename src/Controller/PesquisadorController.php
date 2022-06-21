<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\PesquisadorService;

/**
 * Pesquisador Controller
 *
 * @property \App\Model\Table\PesquisadorTable $Pesquisador
 * @method \App\Model\Entity\Pesquisador[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PesquisadorController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('BryanCrowe/ApiPagination.ApiPagination');
    }

    public function addPesquisador(PesquisadorService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->savePesquisadorUpdate($this->request->getParsedBody(), null));
    }

    public function editPesquisador(PesquisadorService $service)
    {
        $this->request->allowMethod(['put']);

        return $this->Util->convertToJson(200, $service->savePesquisadorUpdate($this->request->getParsedBody(), $this->request->getQuery('id')));
    }

    public function getPesquisadorTable(PesquisadorService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('pesquisador', $this->paginate($service->getPesquisador($this->request->getQuery('search'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['pesquisador']);
    }

    public function getPesquisadores(PesquisadorService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('pesquisador', $this->paginate($service->getPesquisadores($this->request->getQuery('search'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['pesquisador']);
    }

    public function getPesquisador(PesquisadorService $service)
    {
        $this->request->allowMethod(['get']);

        return $this->Util->convertToJson(200, $service->getPesquisadorSelect(filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }


    public function activeAndDisable(PesquisadorService $service)
    {
        $this->request->allowMethod(['delete']);

        return $this->Util->convertToJson(200, $service->updateActiveAndDisable($this->request->getQuery('id'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }
}
