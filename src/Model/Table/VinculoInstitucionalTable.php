<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VinculoInstitucional Model
 *
 * @property \App\Model\Table\PedidoTable&\Cake\ORM\Association\HasMany $Pedido
 *
 * @method \App\Model\Entity\VinculoInstitucional newEmptyEntity()
 * @method \App\Model\Entity\VinculoInstitucional newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\VinculoInstitucional[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VinculoInstitucional get($primaryKey, $options = [])
 * @method \App\Model\Entity\VinculoInstitucional findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\VinculoInstitucional patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VinculoInstitucional[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\VinculoInstitucional|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VinculoInstitucional saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VinculoInstitucional[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\VinculoInstitucional[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\VinculoInstitucional[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\VinculoInstitucional[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class VinculoInstitucionalTable extends Table
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

        $this->setTable('vinculo_institucional');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Pedido', [
            'foreignKey' => 'vinculo_institucional_id',
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
            ->scalar('nome_vinculo_institucional')
            ->maxLength('nome_vinculo_institucional', 255)
            ->requirePresence('nome_vinculo_institucional', 'create')
            ->notEmptyString('nome_vinculo_institucional')
            ->add('nome_vinculo_institucional', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['nome_vinculo_institucional']), ['errorField' => 'nome_vinculo_institucional']);

        return $rules;
    }
}
