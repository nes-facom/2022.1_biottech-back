<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Service;


use App\Utility\UserNewPasswordRequestBody;
use Cake\Http\Exception\BadRequestException;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;
use Exception;

/**
 * Description of UserService
 *
 * @author Leonardo
 */
class UserService
{

    public function saveUser($data)
    {
        $table = TableRegistry::getTableLocator()->get('Users');

        if ($table->find('all')->where(['username' => $data['username']])->first() != null) {
            throw new BadRequestException('Já existe um usuário cadastrado com esse e-mail.');
        }

        $user = $table->newEmptyEntity();

        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->type = $data['type'];

        try {
            return $table->saveOrFail($user);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function getAllUsers($active, $idCurrent)
    {
        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();

        $query = $usersTable->where(['active' => $active, 'id !=' => $idCurrent]);

        foreach ($query as $row) {
            unset($row["active"]);
            unset($row["avatar"]);
        }

        return $query;
    }

    public function getUser($id)
    {
        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();

        try {
            return $usersTable->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Usuário não encontrado.');
        }

    }

    public function updateUser($id, $data)
    {
        $table = TableRegistry::getTableLocator()->get('Users');
        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();

        try {
            $user = $usersTable->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Usuário não encontrado.');
        }

        $user->name = $data['name'];
        $user->type = $data['type'];

        try {
            return $table->saveOrFail($user);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function updateUserPassword($id, $data)
    {
        $table = TableRegistry::getTableLocator()->get('Users');
        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();
        try {
            $user = $usersTable->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Usuário não encontrado.');
        }
        $user->password = $data['password'];
        if ($table->save($user)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUserAvatar($id, $data)
    {
        $table = TableRegistry::getTableLocator()->get('Users');
        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();
        try {
            $user = $usersTable->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Usuário não encontrado.');
        }

        $user->avatar = $data['avatar'];

        try {
            return $table->saveOrFail($user);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function generateNewPassword($id)
    {
        $table = TableRegistry::getTableLocator()->get('Users');
        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();
        try {
            $user = $usersTable->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Usuário não encontrado.');
        }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $user->password = $randomString;

        try {
            $table->saveOrFail($user);
            return new UserNewPasswordRequestBody($randomString);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function updateActiveAndDisable($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('Users');
        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();

        try {
            $user = $usersTable->where(['id' => $id])->first();
        } catch (Exception $e) {
            throw new BadRequestException('Usuário não encontrado.');
        }

        $user->active = $active;

        try {
            return $table->saveOrFail($user);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

}
