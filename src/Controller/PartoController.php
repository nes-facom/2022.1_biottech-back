<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\PartoService;


/**
 * Parto Controller
 *
 * @property \App\Model\Table\PartoTable $Parto
 * @method \App\Model\Entity\Parto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PartoController extends AppController
{

    public function getAllPartos()
    {

        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $responseGetAll = $this->Parto->getAllPartos();

            $response = $this->response
                ->withType('application/json')
                ->withStatus(200)
                ->withStringBody(json_encode($responseGetAll));

            return $this->Util->convertToJson(200, $responseGetAll);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function addParto(PartoService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $service->saveParto($data);

            return $this->Util->convertToJson(201, []);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

}
