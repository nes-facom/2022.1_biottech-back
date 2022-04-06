<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
use App\Utility\UsersGetRequestBody;
use App\Model\Entity\User;
use Cake\I18n\FrozenTime;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Controller
 *
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class UsersController extends AppController {

    public function initialize(): void {
        parent::initialize();

        $this->loadComponent('UserService');

        // $this->UserService->saveUser();
    }

    public function beforeFilter(EventInterface $event) {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login']);
    }

    public function login() {
        $this->request->allowMethod(['post']);

        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            $user = $result->getData();
            $payload = [
                'sub' => $user->id,
                'exp' => time() + 86400,
            ];

            $json = [
                'token' => JWT::encode($payload, Security::getSalt(), 'HS256'),
            ];
        } else {
            $this->response = $this->response->withStatus(401);
            $json = [];
        }

        $this->set(compact('json'));
        $this->viewBuilder()->setOption('serialize', 'json');
    }

    public function getCurrentUser() {
        $identity = $this->Authentication->getIdentity();
        $json = ['user' => $identity->getOriginalData()];

        $this->set(compact('json'));
        $this->viewBuilder()->setOption('serialize', 'json');
    }

    public function logout() {
        $json = [];

        $this->Authentication->logout();

        $this->set(compact('json'));
        $this->viewBuilder()->setOption('serialize', 'json');
    }

    public function getAllUsers() {

        //verificar se é admin e está ativo
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401);
            return $response;
        }

        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $active = filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN);
            $this->UserService->getAllUsers($active);

            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode($this->UserService->getAllUsers($active)));

            return $response;
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401);
            return $response;
        }
    }

    public function getUser() {
        //verificar se é admin e está ativo
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401);
            return $response;
        }

        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $id = $this->request->getQuery('id');
       
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode($this->UserService->getUser($id)));
            return $response;
        } else {
            $this->response = $this->response->withStatus(401);
            $json = [];
        }

        $this->set(compact('json'));
        $this->viewBuilder()->setOption('serialize', 'json');
    }

    public function save() {

        //verificar se é admin e está ativo
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401);
            return $response;
        }

        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->input('json_decode', true);

            if ($this->UserService->saveUser($data)) {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(201);
                return $response;
            } else {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(400);
                return $response;
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401);
            return $response;
        }
    }

    public function update() {

        //verificar se é admin e está ativo
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401);
            return $response;
        }

        //seta os métodos aceitos
        $this->request->allowMethod(['put']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->input('json_decode', true);
            $id = $this->request->getQuery('id');

            $user = $this->UserService->updateUser($id, $data);
            
            if ($user != null) {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(200)
                        ->withStringBody(json_encode($user));
                return $response;
            } else {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(400);
                return $response;
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401);
            return $response;
        }
    }

    public function activeAndDisable() {

        //verificar se é admin e está ativo
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401);
            return $response;
        }
        
        //seta os métodos aceitos
        $this->request->allowMethod(['put']);

        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $id = $this->request->getQuery('id');
            $active = filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN);
            $user = $this->UserService->updateActiveAndDisable($id, $active);

            if ($user != null) {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(200)
                        ->withStringBody(json_encode($user));
                return $response;
            } else {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(400);
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401);
            return $response;
        }
    }

}
