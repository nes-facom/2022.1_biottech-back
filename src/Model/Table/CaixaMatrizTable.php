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
 * @property \App\Model\Table\CaixaTable&\Cake\ORM\Association\BelongsTo $Caixa
 * @property \App\Model\Table\CaixaTable&\Cake\ORM\Association\BelongsTo $Caixa
 * @property \App\Model\Table\CaixaTable&\Cake\ORM\Association\HasMany $Caixa
 * @property \App\Model\Table\PartoMatrizTable&\Cake\ORM\Association\HasMany $PartoMatriz
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

        $this->belongsTo('Caixa', [
            'foreignKey' => 'caixa_macho_id',
        ]);
        $this->belongsTo('Caixa', [
            'foreignKey' => 'caixa_femea_id',
        ]);
        $this->hasMany('Caixa', [
            'foreignKey' => 'caixa_matriz_id',
        ]);
        $this->hasMany('PartoMatriz', [
            'foreignKey' => 'caixa_matriz_id',
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
            ->integer('caixa_macho_id')
            ->allowEmptyString('caixa_macho_id');

        $validator
            ->integer('caixa_femea_id')
            ->allowEmptyString('caixa_femea_id');

        $validator
            ->scalar('caixa_matriz_numero')
            ->maxLength('caixa_matriz_numero', 255)
            ->requirePresence('caixa_matriz_numero', 'create')
            ->notEmptyString('caixa_matriz_numero')
            ->add('caixa_matriz_numero', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('tipo_acasalamento')
            ->maxLength('tipo_acasalamento', 255)
            ->requirePresence('tipo_acasalamento', 'create')
            ->notEmptyString('tipo_acasalamento');

        $validator
            ->integer('num_femea')
            ->requirePresence('num_femea', 'create')
            ->notEmptyString('num_femea');

        $validator
            ->date('data_acasalamento')
            ->requirePresence('data_acasalamento', 'create')
            ->notEmptyDate('data_acasalamento');

        $validator
            ->integer('intervalo_parto')
            ->requirePresence('intervalo_parto', 'create')
            ->notEmptyString('intervalo_parto');

        $validator
            ->decimal('peso_macho')
            ->requirePresence('peso_macho', 'create')
            ->notEmptyString('peso_macho');

        $validator
            ->decimal('peso_femea')
            ->requirePresence('peso_femea', 'create')
            ->notEmptyString('peso_femea');

        $validator
            ->date('saida_da_colonia')
            ->requirePresence('saida_da_colonia', 'create')
            ->notEmptyDate('saida_da_colonia');

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
        $rules->add($rules->existsIn('caixa_macho_id', 'Caixa'), ['errorField' => 'caixa_macho_id']);
        $rules->add($rules->existsIn('caixa_femea_id', 'Caixa'), ['errorField' => 'caixa_femea_id']);

        return $rules;
    }
}
