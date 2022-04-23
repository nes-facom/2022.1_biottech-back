<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Saida Model
 *
 * @property \App\Model\Table\AnoTable&\Cake\ORM\Association\BelongsTo $Ano
 * @property \App\Model\Table\CaixaTable&\Cake\ORM\Association\BelongsTo $Caixa
 *
 * @method \App\Model\Entity\Saida newEmptyEntity()
 * @method \App\Model\Entity\Saida newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Saida[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Saida get($primaryKey, $options = [])
 * @method \App\Model\Entity\Saida findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Saida patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Saida[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Saida|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Saida saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Saida[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Saida[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Saida[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Saida[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SaidaTable extends Table
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

        $this->setTable('saida');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Ano', [
            'foreignKey' => 'ano_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Caixa', [
            'foreignKey' => 'caixa_id',
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
            ->integer('ano_id')
            ->requirePresence('ano_id', 'create')
            ->notEmptyString('ano_id');

        $validator
            ->integer('caixa_id')
            ->allowEmptyString('caixa_id');

        $validator
            ->date('data_saida')
            ->requirePresence('data_saida', 'create')
            ->notEmptyDate('data_saida');

        $validator
            ->scalar('tipo_ocorrencia')
            ->requirePresence('tipo_ocorrencia', 'create')
            ->notEmptyString('tipo_ocorrencia');

        $validator
            ->scalar('usuario')
            ->maxLength('usuario', 255)
            ->allowEmptyString('usuario');

        $validator
            ->integer('num_animais')
            ->requirePresence('num_animais', 'create')
            ->notEmptyString('num_animais');

        $validator
            ->scalar('saida')
            ->requirePresence('saida', 'create')
            ->notEmptyString('saida');

        $validator
            ->scalar('sexo')
            ->requirePresence('sexo', 'create')
            ->notEmptyString('sexo');

        $validator
            ->integer('sobra')
            ->requirePresence('sobra', 'create')
            ->notEmptyString('sobra');

        $validator
            ->scalar('observacoes')
            ->maxLength('observacoes', 255)
            ->allowEmptyString('observacoes');

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
        $rules->add($rules->existsIn('ano_id', 'Ano'), ['errorField' => 'ano_id']);
        $rules->add($rules->existsIn('caixa_id', 'Caixa'), ['errorField' => 'caixa_id']);

        return $rules;
    }
}
