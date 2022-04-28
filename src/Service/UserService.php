<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Service;


use App\Utility\UserNewPasswordRequestBody;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

/**
 * Description of UserService
 *
 * @author Leonardo
 */
class UserService {

    public function saveUser($data) {
        $table = TableRegistry::getTableLocator()->get('Users');
        $user = $table->newEmptyEntity();

        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->type = $data['type'];
        $user->active = true;
        $user->created = FrozenTime::now();
        $user->modified = FrozenTime::now();

        if ($table->save($user)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllUsers($active, $idCurrent) {

        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();

        $query = $usersTable->where(['active' => $active, 'id !=' => $idCurrent]);

        
        foreach ($query as $row) {
            unset($row["created"]);
            unset($row["active"]);
            unset($row["modified"]);
            unset($row["avatar"]);     
   
        }

        return $query;
    }

    public function getUser($id) {

        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();

        $user = $usersTable->where(['id' => $id])->first();

        return $user;
    }

    public function updateUser($id, $data) {
        $table = TableRegistry::getTableLocator()->get('Users');
        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();

        $user = $usersTable->where(['id' => $id])->first();

        $user->name = $data['name'];
        $user->type = $data['type'];
        $user->modified = FrozenTime::now();

        if ($table->save($user)) {
            return $user;
        } else {
            return null;
        }
    }

    public function updateUserPassword($id, $data) {
        $table = TableRegistry::getTableLocator()->get('Users');
        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();

        $user = $usersTable->where(['id' => $id])->first();

        $user->password = $data['password'];
        $user->modified = FrozenTime::now();
        if ($table->save($user)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUserAvatar($id, $data) {
        $table = TableRegistry::getTableLocator()->get('Users');
        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();

        $user = $usersTable->where(['id' => $id])->first();

        $user->avatar = $data['avatar'];
        $user->modified = FrozenTime::now();

        if ($table->save($user)) {
            return $user;
        } else {
            return false;
        }
    }

    public function generateNewPassword($id) {
        $table = TableRegistry::getTableLocator()->get('Users');
        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();

        $user = $usersTable->where(['id' => $id])->first();

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $user->password = $randomString;
        $user->modified = FrozenTime::now();

        if ($table->save($user)) {
            return new UserNewPasswordRequestBody($randomString);
        } else {
            return null;
        }
    }

    public function updateActiveAndDisable($id, $active) {
        $table = TableRegistry::getTableLocator()->get('Users');
        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();

        $user = $usersTable->where(['id' => $id])->first();

        $user->active = $active;
        $user->modified = FrozenTime::now();

        if ($table->save($user)) {
            return $user;
        } else {
            return null;
        }
    }

}
