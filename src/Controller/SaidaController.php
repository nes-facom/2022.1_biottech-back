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
        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $service->saveSaida($data);

            return $this->Util->convertToJson(201, []);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }
}
