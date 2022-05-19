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

        $this->set('progamacaoAcasalamento', $this->paginate($service->getProgamacaoAcasalamento()));
        $this->viewBuilder()->setOption('serialize', ['progamacaoAcasalamento']);
    }

    public function getMatrizesTable(CaixaMatrizService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('matrizes', $this->paginate($service->getMatrizes()));
        $this->viewBuilder()->setOption('serialize', ['matrizes']);
    }
}
