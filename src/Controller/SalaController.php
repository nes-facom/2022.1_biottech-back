<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\SalaService;

/**
 * Sala Controller
 *
 * @property \App\Model\Table\SalaTable $Sala
 * @method \App\Model\Entity\Sala[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SalaController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('BryanCrowe/ApiPagination.ApiPagination');
    }

    public function addSala(SalaService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveSalaAndUpdate($this->request->getParsedBody(), null));
    }

    public function editSala(SalaService $service)
    {
        $this->request->allowMethod(['put']);

        return $this->Util->convertToJson(200, $service->saveSalaAndUpdate($this->request->getParsedBody(), $this->request->getQuery('id')));
    }

    public function addTemperaturaUmidade(SalaService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveTemperaturaUmidadeAndUpdate($this->request->getParsedBody(), null));
    }

    public function editTemperaturaUmidade(SalaService $service)
    {
        $this->request->allowMethod(['put']);

        return $this->Util->convertToJson(200, $service->saveTemperaturaUmidadeAndUpdate($this->request->getParsedBody(), $this->request->getQuery('id')));
    }


    public function getSalas(SalaService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('salas', $this->paginate($service->getSalas($this->request->getQuery('search'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['salas']);
    }

    public function activeAndDisableSala(SalaService $service)
    {
        $this->request->allowMethod(['delete']);

        return $this->Util->convertToJson(200, $service->updateActiveAndDisableSala($this->request->getQuery('id'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }

    public function activeAndDisableTemperaturaUmidade(SalaService $service)
    {
        $this->request->allowMethod(['delete']);

        return $this->Util->convertToJson(200, $service->updateActiveAndDisableTemperaturaUmidade($this->request->getQuery('id'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }

}
