<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SalaLinhagem Model
 *
 * @property \App\Model\Table\LinhagemTable&\Cake\ORM\Association\BelongsTo $Linhagem
 * @property \App\Model\Table\SalaTable&\Cake\ORM\Association\BelongsTo $Sala
 *
 * @method \App\Model\Entity\SalaLinhagem newEmptyEntity()
 * @method \App\Model\Entity\SalaLinhagem newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SalaLinhagem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SalaLinhagem get($primaryKey, $options = [])
 * @method \App\Model\Entity\SalaLinhagem findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SalaLinhagem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SalaLinhagem[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SalaLinhagem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SalaLinhagem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SalaLinhagem[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SalaLinhagem[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SalaLinhagem[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SalaLinhagem[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SalaLinhagemTable extends Table
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

        $this->setTable('sala_linhagem');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Linhagem', [
            'foreignKey' => 'linhagem_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Sala', [
            'foreignKey' => 'sala_id',
            'joinType' => 'INNER',
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
            ->integer('linhagem_id')
            ->requirePresence('linhagem_id', 'create')
            ->notEmptyString('linhagem_id');

        $validator
            ->integer('sala_id')
            ->requirePresence('sala_id', 'create')
            ->notEmptyString('sala_id');

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
        $rules->add($rules->existsIn('linhagem_id', 'Linhagem'), ['errorField' => 'linhagem_id']);
        $rules->add($rules->existsIn('sala_id', 'Sala'), ['errorField' => 'sala_id']);

        return $rules;
    }
}
