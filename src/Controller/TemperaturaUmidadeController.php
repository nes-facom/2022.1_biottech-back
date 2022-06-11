<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\TemperaturaUmidadeService;

/**
 * TemperaturaUmidade Controller
 *
 * @property \App\Model\Table\TemperaturaUmidadeTable $TemperaturaUmidade
 * @method \App\Model\Entity\TemperaturaUmidade[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TemperaturaUmidadeController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('BryanCrowe/ApiPagination.ApiPagination');
    }

    public function getTemperaturaUmidadeTable(TemperaturaUmidadeService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('temperatura', $this->paginate($service->getTemperaturaUmidades($this->request->getQuery('search'), $this->request->getQuery('year'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['temperatura']);
    }

    public function addTemperaturaUmidade(TemperaturaUmidadeService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveTemperaturaUmidadeAndUpdate($this->request->getParsedBody(), null));
    }

    public function editTemperaturaUmidade(TemperaturaUmidadeService $service)
    {
        $this->request->allowMethod(['put']);

        return $this->Util->convertToJson(200, $service->saveTemperaturaUmidadeAndUpdate($this->request->getParsedBody(), $this->request->getQuery('id')));
    }
    public function activeAndDisableTemperaturaUmidade(TemperaturaUmidadeService $service)
    {
        $this->request->allowMethod(['delete']);

        return $this->Util->convertToJson(200, $service->updateActiveAndDisable($this->request->getQuery('id'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }
}
