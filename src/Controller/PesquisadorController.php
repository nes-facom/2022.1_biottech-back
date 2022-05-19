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

        return $this->Util->convertToJson(201, $service->savePesquisadorUpdate($this->request->getParsedBody(), null));
    }

    public function editPesquisador(PesquisadorService $service)
    {
        $this->request->allowMethod(['put']);

        return $this->Util->convertToJson(201, $service->savePesquisadorUpdate($this->request->getParsedBody(), $this->request->getQuery('id')));
    }

    public function getPesquisadorTable(PesquisadorService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('saida', $this->paginate($service->getAllPesquisadores()));
        $this->viewBuilder()->setOption('serialize', ['saida']);
    }
}
