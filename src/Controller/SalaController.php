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
        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $service->saveSalaAndUpdate($data, null);

            return $this->Util->convertToJson(201, []);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function addTemperaturaUmidade(SalaService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $newSaveTemperaturaUmidade = $service->saveTemperaturaUmidadeAndUpdate($data, null);

            return $this->Util->convertToJson(201, $newSaveTemperaturaUmidade);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function getTemperaturaUmidadeTable(SalaService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $responseGetAll = $service->getAllTemperaturaUmidade();

            $this->set('saida', $this->paginate($responseGetAll));
            $this->viewBuilder()->setOption('serialize', ['saida']);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

}
