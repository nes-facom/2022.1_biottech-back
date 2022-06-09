<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CaixaCaixaMatriz Model
 *
 * @property \App\Model\Table\CaixaMatrizTable&\Cake\ORM\Association\BelongsTo $CaixaMatriz
 * @property \App\Model\Table\CaixaTable&\Cake\ORM\Association\BelongsTo $Caixa
 *
 * @method \App\Model\Entity\CaixaCaixaMatriz newEmptyEntity()
 * @method \App\Model\Entity\CaixaCaixaMatriz newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CaixaCaixaMatriz[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CaixaCaixaMatriz get($primaryKey, $options = [])
 * @method \App\Model\Entity\CaixaCaixaMatriz findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CaixaCaixaMatriz patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CaixaCaixaMatriz[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CaixaCaixaMatriz|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CaixaCaixaMatriz saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CaixaCaixaMatriz[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CaixaCaixaMatriz[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CaixaCaixaMatriz[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CaixaCaixaMatriz[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CaixaCaixaMatrizTable extends Table
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

        $this->setTable('caixa_caixa_matriz');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('CaixaMatriz', [
            'foreignKey' => 'caixa_matriz_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Caixa', [
            'foreignKey' => 'caixa_id',
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
            ->integer('caixa_matriz_id')
            ->requirePresence('caixa_matriz_id', 'create')
            ->notEmptyString('caixa_matriz_id');

        $validator
            ->integer('caixa_id')
            ->requirePresence('caixa_id', 'create')
            ->notEmptyString('caixa_id');

        $validator
            ->numeric('peso')
            ->requirePresence('peso', 'create')
            ->notEmptyString('peso');

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
        $rules->add($rules->existsIn('caixa_matriz_id', 'CaixaMatriz'), ['errorField' => 'caixa_matriz_id']);
        $rules->add($rules->existsIn('caixa_id', 'Caixa'), ['errorField' => 'caixa_id']);

        return $rules;
    }
}
