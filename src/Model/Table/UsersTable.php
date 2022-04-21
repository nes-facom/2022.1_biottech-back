<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Utility\UsersGetRequestBody;
use App\Utility\UserNewPasswordRequestBody;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator {
        $validator
                ->scalar('name')
                ->maxLength('name', 255)
                ->requirePresence('name', 'create')
                ->notEmptyString('name');

        $validator
                ->scalar('username')
                ->maxLength('username', 255)
                ->requirePresence('username', 'create')
                ->notEmptyString('username');

        $validator
                ->scalar('password')
                ->maxLength('password', 255)
                ->requirePresence('password', 'create')
                ->notEmptyString('password');

        $validator
                ->integer('type')
                ->requirePresence('type', 'create')
                ->notEmptyString('type');

        $validator
                ->boolean('active')
                ->requirePresence('active', 'create')
                ->notEmptyString('active');

        $validator
                ->scalar('avatar')
                ->allowEmptyString('avatar');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker {
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);

        return $rules;
    }

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

    public function getAllUsers($active, $idCurrent) {

        // Prior to 3.6 use TableRegistry::get('Articles')
        $usersTable = TableRegistry::getTableLocator()->get('Users')->find();

        //$queryUser = $usersTable->all();

        $newUsers = array();
        $query = $usersTable->where(['active' => $active, 'id !=' => $idCurrent]);

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
