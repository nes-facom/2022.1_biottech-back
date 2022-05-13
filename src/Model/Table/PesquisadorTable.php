<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pesquisador Model
 *
 * @property \App\Model\Table\PedidoTable&\Cake\ORM\Association\HasMany $Pedido
 * @property \App\Model\Table\TelefonesTable&\Cake\ORM\Association\HasMany $Telefones
 *
 * @method \App\Model\Entity\Pesquisador newEmptyEntity()
 * @method \App\Model\Entity\Pesquisador newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Pesquisador[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pesquisador get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pesquisador findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Pesquisador patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pesquisador[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pesquisador|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pesquisador saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pesquisador[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pesquisador[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pesquisador[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pesquisador[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PesquisadorTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('pesquisador');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Pedido', [
            'foreignKey' => 'pesquisador_id',
        ]);
        $this->hasMany('Telefones', [
            'foreignKey' => 'pesquisador_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('nome')
            ->maxLength('nome', 255)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->scalar('instituicao')
            ->maxLength('instituicao', 255)
            ->requirePresence('instituicao', 'create')
            ->notEmptyString('instituicao');

        $validator
            ->scalar('setor')
            ->maxLength('setor', 255)
            ->requirePresence('setor', 'create')
            ->notEmptyString('setor');

        $validator
            ->scalar('pos')
            ->maxLength('pos', 255)
            ->allowEmptyString('pos');

        $validator
            ->scalar('ramal')
            ->maxLength('ramal', 255)
            ->allowEmptyString('ramal');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->boolean('orientador')
            ->requirePresence('orientador', 'create')
            ->notEmptyString('orientador');

        $validator
            ->boolean('active')
            ->notEmptyString('active');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);

        return $rules;
    }
}
