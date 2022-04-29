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
class SalaController extends AppController {

    public function initialize(): void {
        parent::initialize();
    }

    public function addSala(SalaService $service) {

        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveSala($data);

            if ($newSave) {
                return $this->Util->convertToJson(201, []);
            } else {
                return $this->Util->convertToJson(400, []);
            }
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function addTemperaturaUmidade(SalaService $service) {

        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->saveTemperaturaUmidade($data);

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
