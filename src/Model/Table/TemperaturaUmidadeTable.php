<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TemperaturaUmidade Model
 *
 * @property \App\Model\Table\SalaTable&\Cake\ORM\Association\BelongsTo $Sala
 *
 * @method \App\Model\Entity\TemperaturaUmidade newEmptyEntity()
 * @method \App\Model\Entity\TemperaturaUmidade newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TemperaturaUmidade[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TemperaturaUmidade get($primaryKey, $options = [])
 * @method \App\Model\Entity\TemperaturaUmidade findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TemperaturaUmidade patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TemperaturaUmidade[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TemperaturaUmidade|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TemperaturaUmidade saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TemperaturaUmidade[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TemperaturaUmidade[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TemperaturaUmidade[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TemperaturaUmidade[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TemperaturaUmidadeTable extends Table
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

        $this->setTable('temperatura_umidade');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Sala', [
            'foreignKey' => 'sala_id',
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
            ->integer('sala_id')
            ->allowEmptyString('sala_id');

        $validator
            ->date('data')
            ->requirePresence('data', 'create')
            ->notEmptyDate('data');

        $validator
            ->numeric('temp_matutino')
            ->allowEmptyString('temp_matutino');

        $validator
            ->scalar('ur_matutino')
            ->maxLength('ur_matutino', 255)
            ->allowEmptyString('ur_matutino');

        $validator
            ->numeric('temp_vespertino')
            ->allowEmptyString('temp_vespertino');

        $validator
            ->scalar('ur_vespertino')
            ->maxLength('ur_vespertino', 255)
            ->allowEmptyString('ur_vespertino');

        $validator
            ->scalar('observacoes')
            ->maxLength('observacoes', 255)
            ->allowEmptyString('observacoes');

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
        $rules->add($rules->existsIn('sala_id', 'Sala'), ['errorField' => 'sala_id']);

        return $rules;
    }
}
