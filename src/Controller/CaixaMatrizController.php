<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\CaixaMatrizService;

/**
 * CaixaMatriz Controller
 *
 * @property \App\Model\Table\CaixaMatrizTable $CaixaMatriz
 * @method \App\Model\Entity\CaixaMatriz[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CaixaMatrizController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('BryanCrowe/ApiPagination.ApiPagination');
    }

    public function addCaixaMatriz(CaixaMatrizService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveCaixaMatrizAndUpdate($this->request->getParsedBody(), null));
    }

    public function editCaixaMatriz(CaixaMatrizService $service)
    {
        $this->request->allowMethod(['put']);

        return $this->Util->convertToJson(201, $service->saveCaixaMatrizAndUpdate($this->request->getParsedBody(), $this->request->getQuery('id')));
    }

    public function getProgamacaoAcasalamentoTable(CaixaMatrizService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('progamacaoAcasalamento', $this->paginate($service->getProgamacaoAcasalamento($this->request->getQuery('search'), $this->request->getQuery('year'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['progamacaoAcasalamento']);
    }

    public function getMatrizesTable(CaixaMatrizService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('matrizes', $this->paginate($service->getMatrizes($this->request->getQuery('search'), $this->request->getQuery('year'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['matrizes']);
    }

    public function getCaixaMatrizes(CaixaMatrizService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('caixa_matrizes', $this->paginate($service->getCaixaMatrizes($this->request->getQuery('search'), $this->request->getQuery('year'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN))));
        $this->viewBuilder()->setOption('serialize', ['caixa_matrizes']);
    }

    public function activeAndDisable(CaixaMatrizService $service)
    {
        $this->request->allowMethod(['delete']);

        return $this->Util->convertToJson(200, $service->updateActiveAndDisable($this->request->getQuery('id'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }
}
