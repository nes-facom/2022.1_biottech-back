<?php

declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Http\Response;

/**
 * Util component
 */
class UtilComponent extends Component
{

    public $components = array('RequestHandler');

    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function convertToJson($status, $data)
    {

        if ($status == 400) {
            $data = [
                'message' => 'Desculpe, estamos passando por problemas técnicos, tente novamente mais tarde ou entre em contato com o suporte.'
            ];
            $response = new Response();
            return $response->withType('application/json')
                ->withStatus($status)
                ->withStringBody(json_encode($data));
        }

        $response = new Response();
        return $response->withType('application/json')
            ->withStatus($status)
            ->withStringBody(json_encode($data));


    }

}
