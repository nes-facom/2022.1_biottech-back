<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\PrevisaoService;

/**
 * Previsao Controller
 *
 * @property \App\Model\Table\PrevisaoTable $Previsao
 * @method \App\Model\Entity\Previsao[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PrevisaoController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
    }

    public function addPrevisao(PrevisaoService $service)
    {

        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $service->savePrevisaoAndUpdate($data, null);

            return $this->Util->convertToJson(201, []);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function editPrevisao(PrevisaoService $service)
    {
        $this->request->allowMethod(['put']);

        if ($this->Authentication->getResult()->isValid()) {

            $id = $this->request->getQuery('id');
            $data = $this->request->getParsedBody();
            $newUpdatePesquisador = $service->savePrevisaoAndUpdate($data, $id);

            return $this->Util->convertToJson(201, $newUpdatePesquisador);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function getPrevisaoTable(PrevisaoService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $responseGetAll = $service->getPrevisao();

            $this->set('saida', $this->paginate($responseGetAll));
            $this->viewBuilder()->setOption('serialize', ['saida']);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

}
