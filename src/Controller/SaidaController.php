<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\SaidaService;

/**
 * Saida Controller
 *
 * @property \App\Model\Table\SaidaTable $Saida
 * @method \App\Model\Entity\Saida[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SaidaController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
    }

    public function addSaida(SaidaService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveSaidaAndUpdate($this->request->getParsedBody(), null));
    }

    public function getSaidaTable(SaidaService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('saida', $this->paginate($service->getSaida()));
        $this->viewBuilder()->setOption('serialize', ['saida']);
    }
}
