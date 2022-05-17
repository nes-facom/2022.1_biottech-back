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

        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveLinhagemAndUpdate($data, null);

            return $this->Util->convertToJson(201, $newSave);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function editLinhagem(LinhagemService $service)
    {
        $this->request->allowMethod(['put']);

        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $id = $this->request->getQuery('id');
            $data = $this->request->getParsedBody();
            $newSave = $service->saveLinhagemAndUpdate($data, $id);

            return $this->Util->convertToJson(201, $newSave);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }
}
