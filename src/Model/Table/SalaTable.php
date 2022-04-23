<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sala Model
 *
 * @property \App\Model\Table\TemperaturaUmidadeTable&\Cake\ORM\Association\HasMany $TemperaturaUmidade
 * @property \App\Model\Table\LinhagemTable&\Cake\ORM\Association\BelongsToMany $Linhagem
 *
 * @method \App\Model\Entity\Sala newEmptyEntity()
 * @method \App\Model\Entity\Sala newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sala[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sala get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sala findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sala patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sala[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sala|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sala saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sala[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sala[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sala[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sala[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SalaTable extends Table
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

        $this->setTable('sala');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('TemperaturaUmidade', [
            'foreignKey' => 'sala_id',
        ]);
        $this->belongsToMany('Linhagem', [
            'foreignKey' => 'sala_id',
            'targetForeignKey' => 'linhagem_id',
            'joinTable' => 'sala_linhagem',
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
            ->integer('num_sala')
            ->requirePresence('num_sala', 'create')
            ->notEmptyString('num_sala')
            ->add('num_sala', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['num_sala']), ['errorField' => 'num_sala']);

        return $rules;
    }
}
