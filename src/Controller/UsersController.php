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
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }

        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $active = filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN);
            $id = $identity->getOriginalData()['id'];
            $responseGetAll = $this->UserService->getAllUsers($active, $id);

            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(200)
                    ->withStringBody(json_encode($responseGetAll));

            return $response;
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
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
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }

    public function save() {

        //verificar se é admin e está ativo
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }

        //seta os métodos aceitos
        $this->request->allowMethod(['post']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();

            if ($this->UserService->saveUser($data)) {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(201)
                        ->withStringBody(json_encode([]));
                return $response;
            } else {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(400)
                        ->withStringBody(json_encode([]));
                return $response;
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }

    public function update() {

        //verificar se é admin e está ativo
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }

        //seta os métodos aceitos
        $this->request->allowMethod(['put']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
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
                        ->withStatus(400)
                        ->withStringBody(json_encode([]));
                return $response;
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }

    public function updatePassword() {

        $identity = $this->Authentication->getIdentity();

        //seta os métodos aceitos
        $this->request->allowMethod(['put']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $id = $identity->getOriginalData()['id'];

            $user = $this->UserService->updateUserPassword($id, $data);

            if ($user) {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(200)
                        ->withStringBody(json_encode([]));
                return $response;
            } else {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(400)
                        ->withStringBody(json_encode([]));
                return $response;
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }

    public function newPassword() {

        //verificar se é admin e está ativo
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }

        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $id = $this->request->getQuery('id');

            $user = $this->UserService->generateNewPassword($id);

            if ($user != null) {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(200)
                        ->withStringBody(json_encode($user));
                return $response;
            } else {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(400)
                        ->withStringBody(json_encode([]));
                return $response;
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }

    public function activeAndDisable() {

        //verificar se é admin e está ativo
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
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
                        ->withStatus(400)
                        ->withStringBody(json_encode([]));
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }

    public function updateAvatar() {

        $identity = $this->Authentication->getIdentity();

        //seta os métodos aceitos
        $this->request->allowMethod(['put']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            //$data = $this->request->input('json_decode', true);
            $data = $this->request->getParsedBody();
            $id = $identity->getOriginalData()['id'];

            $user = $this->UserService->updateUserAvatar($id, $data);

            if ($user != null) {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(200)
                        ->withStringBody(json_encode($user));
                return $response;
            } else {
                $response = $this->response
                        ->withType('application/json')
                        ->withStatus(400)
                        ->withStringBody(json_encode([]));
                return $response;
            }
        } else {
            $response = $this->response
                    ->withType('application/json')
                    ->withStatus(401)
                    ->withStringBody(json_encode([]));
            return $response;
        }
    }

}
