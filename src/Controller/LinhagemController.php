<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\LinhagemService;

/**
 * Linhagem Controller
 *
 * @property \App\Model\Table\LinhagemTable $Linhagem
 * @method \App\Model\Entity\Linhagem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LinhagemController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
    }

    public function addLinhagem(LinhagemService $service)
    {
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveLinhagemAndUpdate($this->request->getParsedBody(), null));
    }

    public function editLinhagem(LinhagemService $service)
    {
        $this->request->allowMethod(['put']);

        return $this->Util->convertToJson(201, $service->saveLinhagemAndUpdate($this->request->getParsedBody(), $this->request->getQuery('id')));
    }

    public function getLinhagens(LinhagemService $service)
    {
        $this->request->allowMethod(['get']);

        $this->set('linhagens', $this->paginate($service->getLinhagens()));
        $this->viewBuilder()->setOption('serialize', ['linhagens']);
    }

    public function activeAndDisable(LinhagemService $service)
    {
        $this->request->allowMethod(['delete']);

        return $this->Util->convertToJson(200, $service->updateActiveAndDisable($this->request->getQuery('id'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }
}
