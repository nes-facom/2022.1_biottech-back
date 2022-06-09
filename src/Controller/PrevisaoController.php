<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\PrevisaoService;

/**
 * Previsao Controller
 *
 * @property \App\Model\Table\PrevisaoTable $Previsao
 * @method \App\Model\Entity\Previsao[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PrevisaoController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('BryanCrowe/ApiPagination.ApiPagination');
    }

    public function addPrevisao(PrevisaoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->savePrevisaoAndUpdate($this->request->getParsedBody(), null));
    }

    public function editPrevisao(PrevisaoService $service)
    {
        $this->request->allowMethod(['put']);

        return $this->Util->convertToJson(200, $service->savePrevisaoAndUpdate($this->request->getParsedBody(), $this->request->getQuery('id')));
    }

    public function getPrevisaoTable(PrevisaoService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('previsao', $this->paginate($service->getPrevisao($this->request->getQuery('search'), $this->request->getQuery('year'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['previsao']);
    }

    public function getPrevisoes(PrevisaoService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('previsao', $this->paginate($service->getPrevisoes($this->request->getQuery('search'), $this->request->getQuery('year'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['previsao']);
    }

    public function activeAndDisable(PrevisaoService $service)
    {
        $this->request->allowMethod(['delete']);

        return $this->Util->convertToJson(200, $service->updateActiveAndDisable($this->request->getQuery('id'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }
}
