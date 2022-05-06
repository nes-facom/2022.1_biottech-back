<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\CaixaService;

/**
 * Caixa Controller
 *
 * @property \App\Model\Table\CaixaTable $Caixa
 * @method \App\Model\Entity\Caixa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CaixaController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('BryanCrowe/ApiPagination.ApiPagination');
    }

    public function addCaixa(CaixaService $service)
    {

        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $service->saveCaixa($data);

            return $this->Util->convertToJson(201, []);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function getEntradaDadosTable(CaixaService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $responseGetAll = $service->getEntradaDados();

            $this->set('entradaDados', $this->paginate($responseGetAll));
            $this->viewBuilder()->setOption('serialize', ['entradaDados']);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

}
