<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\PesquisadorSerice;

/**
 * Pesquisador Controller
 *
 * @property \App\Model\Table\PesquisadorTable $Pesquisador
 * @method \App\Model\Entity\Pesquisador[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PesquisadorController extends AppController {

    public function initialize(): void {
        parent::initialize();
    }
    public function addPesquisador(PesquisadorSerice $service) {

        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSave = $service->savePesquisador($data);

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
