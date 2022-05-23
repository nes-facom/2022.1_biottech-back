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

        return $this->Util->convertToJson(201, $service->savePrevisaoAndUpdate($this->request->getParsedBody(), $this->request->getQuery('id')));
    }

    public function getPrevisaoTable(PrevisaoService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('previsao', $this->paginate($service->getPrevisao()));
        $this->viewBuilder()->setOption('serialize', ['previsao']);
    }

    public function getPrevisoes(PrevisaoService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('previsao', $this->paginate($service->getPrevisoes()));
        $this->viewBuilder()->setOption('serialize', ['previsao']);
    }
}
