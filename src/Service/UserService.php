<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Service;

use Cake\Http\Exception\BadRequestException;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;
use Exception;
use function PHPUnit\Framework\isEmpty;

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
        $user->created = FrozenTime::now();
        $user->modified = FrozenTime::now();

        try {
            return $table->saveOrFail($user);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }

    public function getAllUsers($search, $active, $idCurrent)
    {
        $findInTable = [
            'LOWER(concat(".", name, ".",
             username, ".")) LIKE' => strtolower("%" . $search . "%")
        ];

        $table = TableRegistry::getTableLocator()->get('Users');

        return $table->find('all')->select(['id',
            'name',
            'username',
            'type',
            'active'
        ])->where($findInTable)->andWhere(['active' => $active, 'id !=' => $idCurrent])->order(['created' => 'DESC']);
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
        $user->modified = FrozenTime::now();

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

        if (empty($data['password']) || !is_string($data['password'])) {
            throw new BadRequestException('Senha com formato incorreto.');
        }

        $user->password = $data['password'];
        $user->modified = FrozenTime::now();

        return $table->saveOrFail($user);
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
        $user->modified = FrozenTime::now();

        $table->saveOrFail($user)->password;
        return $randomString;
    }

    public function updateActiveAndDisable($id, $active)
    {
        $table = TableRegistry::getTableLocator()->get('Users');
        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();

        try {
            $user = $usersTable->where(['id' => $id])->firstOrFail();
        } catch (Exception $e) {
            throw new BadRequestException('Usuário não encontrado.');
        }

        $user->active = $active;
        $user->modified = FrozenTime::now();

        try {
            return $table->saveOrFail($user);
        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }
    }
}
