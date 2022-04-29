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
class PrevisaoController extends AppController {

    public function initialize(): void {
        parent::initialize();
    }

    public function addPrevisao(PrevisaoService $service) {

        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->savePrevisao($data);

            if ($newSave) {
                return $this->Util->convertToJson(201, []);
            } else {
                return $this->Util->convertToJson(400, []);
            }
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

}
