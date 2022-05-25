<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\SaidaService;

/**
 * Saida Controller
 *
 * @property \App\Model\Table\SaidaTable $Saida
 * @method \App\Model\Entity\Saida[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SaidaController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('BryanCrowe/ApiPagination.ApiPagination');
    }

    public function addSaida(SaidaService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveSaidaAndUpdate($this->request->getParsedBody(), null));
    }

    public function editSaida(SaidaService $service)
    {
        $this->request->allowMethod(['put']);

        return $this->Util->convertToJson(200, $service->saveSaidaAndUpdate($this->request->getParsedBody(), $this->request->getQuery('id')));
    }

    public function getSaidaTable(SaidaService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('saida', $this->paginate($service->getSaida($this->request->getQuery('search'), $this->request->getQuery('year'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['saida']);
    }

    public function getSaidas(SaidaService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('saida', $this->paginate($service->getSaidas($this->request->getQuery('search'), $this->request->getQuery('year'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['saida']);
    }

    public function activeAndDisable(SaidaService $service)
    {
        $this->request->allowMethod(['delete']);

        return $this->Util->convertToJson(200, $service->updateActiveAndDisable($this->request->getQuery('id'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }
}
