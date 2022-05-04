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

        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveLinhagem($data);

            return $this->Util->convertToJson(201, $newSave);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

}
