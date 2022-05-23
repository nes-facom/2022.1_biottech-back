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

        $service->saveSalaAndUpdate($this->request->getParsedBody(), null);

        return $this->Util->convertToJson(201, []);
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

    public function getTemperaturaUmidadeTable(SalaService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('temperatura', $this->paginate($service->getTemperaturaUmidades()));
        $this->viewBuilder()->setOption('serialize', ['temperatura']);
    }

    public function getSalas(SalaService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('salas', $this->paginate($service->getSalas()));
        $this->viewBuilder()->setOption('serialize', ['salas']);
    }

}
