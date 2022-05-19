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

    public function getAllPartos()
    {
        $this->request->allowMethod(['get']);

        $this->set('partos', $this->paginate($this->Parto->getAllPartos()));
        $this->viewBuilder()->setOption('serialize', ['partos']);
    }

    public function addParto(PartoService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->savePartoAndUpdate($this->request->getParsedBody(), null));
    }

    public function getNascDesmaTable(PartoService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('partos', $this->paginate($service->getNascDesma()));
        $this->viewBuilder()->setOption('serialize', ['partos']);
    }

}
