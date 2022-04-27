<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PrevisaoSaida Model
 *
 * @property \App\Model\Table\PrevisaoTable&\Cake\ORM\Association\BelongsTo $Previsao
 * @property \App\Model\Table\SaidaTable&\Cake\ORM\Association\BelongsTo $Saida
 *
 * @method \App\Model\Entity\PrevisaoSaida newEmptyEntity()
 * @method \App\Model\Entity\PrevisaoSaida newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PrevisaoSaida[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PrevisaoSaida get($primaryKey, $options = [])
 * @method \App\Model\Entity\PrevisaoSaida findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PrevisaoSaida patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PrevisaoSaida[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PrevisaoSaida|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PrevisaoSaida saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PrevisaoSaida[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PrevisaoSaida[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PrevisaoSaida[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PrevisaoSaida[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PrevisaoSaidaTable extends Table
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

        $this->setTable('previsao_saida');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Previsao', [
            'foreignKey' => 'previsao_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Saida', [
            'foreignKey' => 'saida_id',
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
            ->integer('previsao_id')
            ->requirePresence('previsao_id', 'create')
            ->notEmptyString('previsao_id');

        $validator
            ->integer('saida_id')
            ->requirePresence('saida_id', 'create')
            ->notEmptyString('saida_id');

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
        $rules->add($rules->existsIn('previsao_id', 'Previsao'), ['errorField' => 'previsao_id']);
        $rules->add($rules->existsIn('saida_id', 'Saida'), ['errorField' => 'saida_id']);

        return $rules;
    }
}
