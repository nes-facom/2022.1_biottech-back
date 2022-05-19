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
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->savePrevisaoAndUpdate($this->request->getParsedBody(), null));
    }

    public function editPrevisao(PrevisaoService $service)
    {
        $this->request->allowMethod(['put']);

        return $this->Util->convertToJson(201, $service->savePrevisaoAndUpdate($this->request->getParsedBody(), $this->request->getQuery('id')));
    }

    public function getPrevisaoTable(PrevisaoService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('saida', $this->paginate($service->getPrevisao()));
        $this->viewBuilder()->setOption('serialize', ['saida']);
    }
}
