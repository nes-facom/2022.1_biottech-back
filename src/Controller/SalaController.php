<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\SalaService;

/**
 * Sala Controller
 *
 * @property \App\Model\Table\SalaTable $Sala
 * @method \App\Model\Entity\Sala[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SalaController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
    }

    public function addSala(SalaService $service)
    {
        $this->request->allowMethod(['post']);

        $data = $this->request->getParsedBody();
        $service->saveSalaAndUpdate($data, null);

        return $this->Util->convertToJson(201, []);
    }

    public function addTemperaturaUmidade(SalaService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveTemperaturaUmidadeAndUpdate($this->request->getParsedBody(), null));
    }

    public function getTemperaturaUmidadeTable(SalaService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('saida', $this->paginate($service->getAllTemperaturaUmidade()));
        $this->viewBuilder()->setOption('serialize', ['saida']);
    }

}
