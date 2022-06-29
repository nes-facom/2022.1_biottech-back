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
        $this->loadComponent('BryanCrowe/ApiPagination.ApiPagination');
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
                'type' => $user->type,
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
        $this->request->allowMethod(['get']);

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
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            return $this->Util->convertToJson(401, []);
        }

        $this->request->allowMethod(['get']);

        $this->set('user', $this->paginate($service->getAllUsers($this->request->getQuery('search'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN), $identity->getOriginalData()['id'])));
        $this->viewBuilder()->setOption('serialize', ['user']);
    }

    public function getUser(UserService $service)
    {
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            return $this->Util->convertToJson(401, []);
        }

        $this->request->allowMethod(['get']);

        return $this->Util->convertToJson(200, $service->getUser($this->request->getQuery('id')));
    }

    public function addUser(UserService $service)
    {
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            return $this->Util->convertToJson(401, []);
        }
        $this->request->allowMethod(['post']);

        return $this->Util->convertToJson(201, $service->saveUser($this->request->getParsedBody()));
    }

    public function editUser(UserService $service)
    {
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            return $this->Util->convertToJson(401, []);
        }

        $this->request->allowMethod(['put']);

        return $this->Util->convertToJson(200, $service->updateUser($this->request->getQuery('id'), $this->request->getParsedBody()));
    }

    public function editPassword(UserService $service)
    {
        $identity = $this->Authentication->getIdentity();

        $this->request->allowMethod(['put']);

        $service->updateUserPassword($identity->getOriginalData()['id'], $this->request->getParsedBody());

        return $this->Util->convertToJson(200, []);
    }

    public function newPassword(UserService $service)
    {
        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            return $this->Util->convertToJson(401, []);
        }

        $this->request->allowMethod(['get']);

        return $this->Util->convertToJson(200, $service->generateNewPassword($this->request->getQuery('id')));
    }

    public function activeAndDisable(UserService $service)
    {

        $identity = $this->Authentication->getIdentity();
        if ($identity->getOriginalData()['type'] == 1 || $identity->getOriginalData()['active'] == false) {
            return $this->Util->convertToJson(401, []);
        }

        $this->request->allowMethod(['delete']);

        return $this->Util->convertToJson(200, $service->updateActiveAndDisable($this->request->getQuery('id'), filter_var($this->request->getQuery('active'), FILTER_VALIDATE_BOOLEAN)));
    }

}
