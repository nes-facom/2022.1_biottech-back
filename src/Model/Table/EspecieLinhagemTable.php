<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EspecieLinhagem Model
 *
 * @property \App\Model\Table\SubLinhaPesquisaTable&\Cake\ORM\Association\BelongsTo $SubLinhaPesquisa
 * @property \App\Model\Table\LinhaPesquisaTable&\Cake\ORM\Association\BelongsTo $LinhaPesquisa
 *
 * @method \App\Model\Entity\EspecieLinhagem newEmptyEntity()
 * @method \App\Model\Entity\EspecieLinhagem newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\EspecieLinhagem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EspecieLinhagem get($primaryKey, $options = [])
 * @method \App\Model\Entity\EspecieLinhagem findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\EspecieLinhagem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EspecieLinhagem[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\EspecieLinhagem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EspecieLinhagem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EspecieLinhagem[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EspecieLinhagem[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\EspecieLinhagem[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\EspecieLinhagem[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class EspecieLinhagemTable extends Table
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

        $this->setTable('especie_linhagem');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('SubLinhaPesquisa', [
            'foreignKey' => 'especie_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('LinhaPesquisa', [
            'foreignKey' => 'linhagem_id',
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
            ->integer('especie_id')
            ->requirePresence('especie_id', 'create')
            ->notEmptyString('especie_id');

        $validator
            ->integer('linhagem_id')
            ->requirePresence('linhagem_id', 'create')
            ->notEmptyString('linhagem_id');

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
        $rules->add($rules->existsIn('especie_id', 'SubLinhaPesquisa'), ['errorField' => 'especie_id']);
        $rules->add($rules->existsIn('linhagem_id', 'LinhaPesquisa'), ['errorField' => 'linhagem_id']);

        return $rules;
    }
}
