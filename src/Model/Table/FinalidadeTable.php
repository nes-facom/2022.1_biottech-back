<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Finalidade Model
 *
 * @property \App\Model\Table\PedidoTable&\Cake\ORM\Association\HasMany $Pedido
 *
 * @method \App\Model\Entity\Finalidade newEmptyEntity()
 * @method \App\Model\Entity\Finalidade newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Finalidade[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Finalidade get($primaryKey, $options = [])
 * @method \App\Model\Entity\Finalidade findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Finalidade patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Finalidade[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Finalidade|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Finalidade saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Finalidade[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Finalidade[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Finalidade[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Finalidade[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class FinalidadeTable extends Table
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

        $this->setTable('finalidade');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Pedido', [
            'foreignKey' => 'finalidade_id',
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
            ->scalar('nome_finalidade')
            ->maxLength('nome_finalidade', 255)
            ->requirePresence('nome_finalidade', 'create')
            ->notEmptyString('nome_finalidade')
            ->add('nome_finalidade', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['nome_finalidade']), ['errorField' => 'nome_finalidade']);

        return $rules;
    }
}
