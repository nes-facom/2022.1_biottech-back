<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CaixaMatriz Model
 *
 * @property \App\Model\Table\PartoTable&\Cake\ORM\Association\HasMany $Parto
 * @property \App\Model\Table\CaixaTable&\Cake\ORM\Association\BelongsToMany $Caixa
 *
 * @method \App\Model\Entity\CaixaMatriz newEmptyEntity()
 * @method \App\Model\Entity\CaixaMatriz newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CaixaMatriz[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CaixaMatriz get($primaryKey, $options = [])
 * @method \App\Model\Entity\CaixaMatriz findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CaixaMatriz patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CaixaMatriz[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CaixaMatriz|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CaixaMatriz saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CaixaMatriz[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CaixaMatriz[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CaixaMatriz[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CaixaMatriz[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CaixaMatrizTable extends Table
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

        $this->setTable('caixa_matriz');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Parto', [
            'foreignKey' => 'caixa_matriz_id',
        ]);
        $this->belongsToMany('Caixa', [
            'foreignKey' => 'caixa_matriz_id',
            'targetForeignKey' => 'caixa_id',
            'joinTable' => 'caixa_caixa_matriz',
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
            ->scalar('caixa_matriz_numero')
            ->maxLength('caixa_matriz_numero', 255)
            ->requirePresence('caixa_matriz_numero', 'create')
            ->notEmptyString('caixa_matriz_numero')
            ->add('caixa_matriz_numero', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->date('data_acasalamento')
            ->requirePresence('data_acasalamento', 'create')
            ->notEmptyDate('data_acasalamento');

        $validator
            ->date('saida_da_colonia')
            ->allowEmptyDate('saida_da_colonia');

        $validator
            ->date('data_obito')
            ->allowEmptyDate('data_obito');

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
        $rules->add($rules->isUnique(['caixa_matriz_numero']), ['errorField' => 'caixa_matriz_numero']);

        return $rules;
    }
}
