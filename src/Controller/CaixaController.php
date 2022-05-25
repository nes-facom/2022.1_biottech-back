<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\CaixaService;

/**
 * Caixa Controller
 *
 * @property \App\Model\Table\CaixaTable $Caixa
 * @method \App\Model\Entity\Caixa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CaixaController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('BryanCrowe/ApiPagination.ApiPagination');
    }

    public function addCaixa(CaixaService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveCaixaAndUpdate($this->request->getParsedBody(), null));
    }

    public function editCaixa(CaixaService $service)
    {
        $this->request->allowMethod(['put']);

        return $this->Util->convertToJson(201, $service->saveCaixaAndUpdate($this->request->getParsedBody(), $this->request->getQuery('id')));
    }

    public function getEntradaDadosTable(CaixaService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('entradaDados', $this->paginate($service->getEntradaDados($this->request->getQuery('search'), $this->request->getQuery('year'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['entradaDados']);
    }

    public function getCaixas(CaixaService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('caixas', $this->paginate($service->getCaixas($this->request->getQuery('search'), $this->request->getQuery('year'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['caixas']);
    }

    public function activeAndDisable(CaixaService $service)
    {
        $this->request->allowMethod(['delete']);

        return $this->Util->convertToJson(200, $service->updateActiveAndDisable($this->request->getQuery('id'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }


}
