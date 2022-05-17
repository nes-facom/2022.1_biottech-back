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
        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSaveCaixaMatriz =  $service->saveCaixaMatrizAndUpdate($data, null);

            return $this->Util->convertToJson(201, $newSaveCaixaMatriz);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function getProgamacaoAcasalamentoTable(CaixaMatrizService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $responseGetAll = $service->getProgamacaoAcasalamento();

            $this->set('progamacaoAcasalamento', $this->paginate($responseGetAll));
            $this->viewBuilder()->setOption('serialize', ['progamacaoAcasalamento']);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function getMatrizesTable(CaixaMatrizService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $responseGetAll = $service->getMatrizes();

            $this->set('matrizes', $this->paginate($responseGetAll));
            $this->viewBuilder()->setOption('serialize', ['matrizes']);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }
}
