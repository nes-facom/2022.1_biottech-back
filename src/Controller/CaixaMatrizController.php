<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\CaixaMatrizService;

/**
 * CaixaMatriz Controller
 *
 * @property \App\Model\Table\CaixaMatrizTable $CaixaMatriz
 * @method \App\Model\Entity\CaixaMatriz[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CaixaMatrizController extends AppController
{
    public function addCaixaMatriz(CaixaMatrizService $service)
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $service->saveCaixaMatriz($data);

            return $this->Util->convertToJson(201, []);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }
}
