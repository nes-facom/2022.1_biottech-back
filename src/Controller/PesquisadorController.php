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

        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $service->savePesquisador($data);

            return $this->Util->convertToJson(201, []);

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
            $responseGetAll = $service->getPesquisador();

            $this->set('saida', $this->paginate($responseGetAll));
            $this->viewBuilder()->setOption('serialize', ['saida']);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }


}
