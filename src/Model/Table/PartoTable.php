<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parto Model
 *
 * @property \App\Model\Table\PartoMatrizTable&\Cake\ORM\Association\HasMany $PartoMatriz
 *
 * @method \App\Model\Entity\Parto newEmptyEntity()
 * @method \App\Model\Entity\Parto newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Parto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Parto get($primaryKey, $options = [])
 * @method \App\Model\Entity\Parto findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Parto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Parto[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Parto|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Parto saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Parto[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Parto[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Parto[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Parto[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PartoTable extends Table
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

        $this->setTable('parto');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('PartoMatriz', [
            'foreignKey' => 'parto_id',
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
            ->integer('numero_parto')
            ->requirePresence('numero_parto', 'create')
            ->notEmptyString('numero_parto');

        $validator
            ->date('data_parto')
            ->requirePresence('data_parto', 'create')
            ->notEmptyDate('data_parto');

        $validator
            ->integer('num_macho')
            ->requirePresence('num_macho', 'create')
            ->notEmptyString('num_macho');

        $validator
            ->integer('num_femea')
            ->requirePresence('num_femea', 'create')
            ->notEmptyString('num_femea');

        $validator
            ->integer('des_macho')
            ->requirePresence('des_macho', 'create')
            ->notEmptyString('des_macho');

        $validator
            ->integer('des_femea')
            ->requirePresence('des_femea', 'create')
            ->notEmptyString('des_femea');

        $validator
            ->integer('qtd_canib')
            ->requirePresence('qtd_canib', 'create')
            ->notEmptyString('qtd_canib');

        $validator
            ->integer('qtd_gamba')
            ->requirePresence('qtd_gamba', 'create')
            ->notEmptyString('qtd_gamba');

        $validator
            ->integer('qtd_outros')
            ->allowEmptyString('qtd_outros');

        return $validator;
    }
}
