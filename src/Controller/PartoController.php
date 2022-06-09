<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\PartoService;


/**
 * Parto Controller
 *
 * @property \App\Model\Table\PartoTable $Parto
 * @method \App\Model\Entity\Parto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PartoController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('BryanCrowe/ApiPagination.ApiPagination');
    }

    public function getPartos(PartoService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('partos', $this->paginate($service->getPartos($this->request->getQuery('search'), $this->request->getQuery('year'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['partos']);
    }

    public function addParto(PartoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->savePartoAndUpdate($this->request->getParsedBody(), null));
    }

    public function editParto(PartoService $service)
    {
        $this->request->allowMethod(['put']);

        return $this->Util->convertToJson(201, $service->savePartoAndUpdate($this->request->getParsedBody(), $this->request->getQuery('id')));
    }

    public function getNascDesmaTable(PartoService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('partos', $this->paginate($service->getNascDesma($this->request->getQuery('search'), $this->request->getQuery('year'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['partos']);
    }

    public function activeAndDisable(PartoService $service)
    {
        $this->request->allowMethod(['delete']);

        return $this->Util->convertToJson(200, $service->updateActiveAndDisable($this->request->getQuery('id'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }

}
