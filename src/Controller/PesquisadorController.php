<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\PesquisadorService;

/**
 * Pesquisador Controller
 *
 * @property \App\Model\Table\PesquisadorTable $Pesquisador
 * @method \App\Model\Entity\Pesquisador[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PesquisadorController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
    }

    public function addPesquisador(PesquisadorService $service)
    {
        $this->request->allowMethod(['post']);

        if ($this->Authentication->getResult()->isValid()) {

            $data = $this->request->getParsedBody();
            $newSavePesquisador = $service->savePesquisadorUpdate($data, null);

            return $this->Util->convertToJson(201, $newSavePesquisador);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function editPesquisador(PesquisadorService $service)
    {
        $this->request->allowMethod(['put']);

        if ($this->Authentication->getResult()->isValid()) {

            $id = $this->request->getQuery('id');
            $data = $this->request->getParsedBody();
            $newUpdatePesquisador = $service->savePesquisadorUpdate($data, $id);

            return $this->Util->convertToJson(201, $newUpdatePesquisador);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function getPesquisadorTable(PesquisadorService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $responseGetAll = $service->getAllPesquisadores();

            $this->set('saida', $this->paginate($responseGetAll));
            $this->viewBuilder()->setOption('serialize', ['saida']);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }


}
