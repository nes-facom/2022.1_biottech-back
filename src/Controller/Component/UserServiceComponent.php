<?php

declare(strict_types=1);

namespace App\Controller\Component;

use App\Utility\UsersGetRequestBody;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

/**
 * UserService component
 */
class UserServiceComponent extends Component {

    public function initialize(array $config): void {
        parent::initialize($config);
    }

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function saveUser($data) {
        $table = \Cake\ORM\TableRegistry::getTableLocator()->get('Users');
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

    public function getAllUsers($active) {

        // Prior to 3.6 use TableRegistry::get('Articles')
        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();

        //$queryUser = $usersTable->all();

        $newUsers = array();
        $query = $usersTable->where(['active' => $active]);

        foreach ($query as $row) {
            $newUser = new UsersGetRequestBody($row->id, $row->name, $row->username, $row->type);
            array_push($newUsers, $newUser);
        }

        return $newUsers;
    }

    public function getUser($id) {

        // Prior to 3.6 use TableRegistry::get('Articles')
        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();

        //$queryUser = $usersTable->all();

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
