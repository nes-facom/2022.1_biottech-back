<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
use App\Service\UserService;

/**
 * Users Controller
 *
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class UsersController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login']);
    }

    public function login()
    {
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

    public function getCurrentUser()
    {
        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $identity = $this->Authentication->getIdentity();
            $json = ['user' => $identity->getOriginalData()];

            $this->set(compact('json'));
            $this->viewBuilder()->setOption('serialize', 'json');
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function logout()
    {
        $json = [];

        $this->Authentication->logout();

        $this->set(compact('json'));
        $this->viewBuilder()->setOption('serialize', 'json');
    }

    public function getAllUsers(UserService $service)
    {

        //verificar se é admin e está ativo
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            return $this->Util->convertToJson(401, []);
        }

        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $active = filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN);
            $id = $identity->getOriginalData()['id'];
            $responseGetAll = $service->getAllUsers($active, $id);

            return $this->Util->convertToJson(200, $responseGetAll);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function getUser(UserService $service)
    {
        //verificar se é admin e está ativo
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            return $this->Util->convertToJson(401, []);
        }

        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $id = $this->request->getQuery('id');

            return $this->Util->convertToJson(200, $service->getUser($id));
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function save(UserService $service)
    {
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            return $this->Util->convertToJson(401, []);
        }

        $this->request->allowMethod(['post']);

        if ($this->Authentication->getResult()->isValid()) {
            $data = $this->request->getParsedBody();
            $newSaveUser = $service->saveUser($data);

            return $this->Util->convertToJson(201, $newSaveUser);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function update(UserService $service)
    {

        //verificar se é admin e está ativo
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            return $this->Util->convertToJson(401, []);
        }

        //seta os métodos aceitos
        $this->request->allowMethod(['put']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $id = $this->request->getQuery('id');

            $user = $service->updateUser($id, $data);

            return $this->Util->convertToJson(200, $user);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function updatePassword(UserService $service)
    {

        $identity = $this->Authentication->getIdentity();

        //seta os métodos aceitos
        $this->request->allowMethod(['put']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $data = $this->request->getParsedBody();
            $id = $identity->getOriginalData()['id'];

            $user = $service->updateUserPassword($id, $data);

            if ($user) {
                return $this->Util->convertToJson(200, []);
            } else {
                return $this->Util->convertToJson(400, []);
            }
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function newPassword(UserService $service)
    {

        //verificar se é admin e está ativo
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            return $this->Util->convertToJson(401, []);
        }

        //seta os métodos aceitos
        $this->request->allowMethod(['get']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $id = $this->request->getQuery('id');

            $user = $service->generateNewPassword($id);

            return $this->Util->convertToJson(200, $user);

        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function activeAndDisable(UserService $service)
    {

        //verificar se é admin e está ativo
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            return $this->Util->convertToJson(401, []);
        }

        //seta os métodos aceitos
        $this->request->allowMethod(['put']);

        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            $id = $this->request->getQuery('id');
            $active = filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN);
            $user = $service->updateActiveAndDisable($id, $active);

            return $this->Util->convertToJson(200, $user);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

    public function updateAvatar(UserService $service)
    {
        $identity = $this->Authentication->getIdentity();

        //seta os métodos aceitos
        $this->request->allowMethod(['put']);

        //verifica se o token é valido
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {

            //$data = $this->request->input('json_decode', true);
            $data = $this->request->getParsedBody();
            $id = $identity->getOriginalData()['id'];

            $user = $service->updateUserAvatar($id, $data);

            return $this->Util->convertToJson(200, $user);
        } else {
            return $this->Util->convertToJson(401, []);
        }
    }

}
