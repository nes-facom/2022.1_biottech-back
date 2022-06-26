<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Caixa Model
 *
 * @property \App\Model\Table\LinhagemTable&\Cake\ORM\Association\BelongsTo $Linhagem
 * @property \App\Model\Table\CaixaMatrizTable&\Cake\ORM\Association\BelongsTo $CaixaMatriz
 * @property \App\Model\Table\SaidaTable&\Cake\ORM\Association\HasMany $Saida
 *
 * @method \App\Model\Entity\Caixa newEmptyEntity()
 * @method \App\Model\Entity\Caixa newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Caixa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Caixa get($primaryKey, $options = [])
 * @method \App\Model\Entity\Caixa findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Caixa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Caixa[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Caixa|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Caixa saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Caixa[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Caixa[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Caixa[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Caixa[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CaixaTable extends Table
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

        $this->setTable('caixa');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Caixa', [
            'foreignKey' => 'caixa_id',
        ]);

        $this->belongsTo('Linhagem', [
            'foreignKey' => 'linhagem_id',
        ]);
        $this->belongsTo('CaixaMatriz', [
            'foreignKey' => 'caixa_matriz_id',
        ]);
        $this->hasMany('Saida', [
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
            ->integer('linhagem_id')
            ->allowEmptyString('linhagem_id');

        $validator
            ->integer('caixa_matriz_id')
            ->allowEmptyString('caixa_matriz_id');

        $validator
            ->scalar('caixa_numero')
            ->maxLength('caixa_numero', 255)
            ->requirePresence('caixa_numero', 'create')
            ->notEmptyString('caixa_numero')
            ->add('caixa_numero', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->date('nascimento')
            ->requirePresence('nascimento', 'create')
            ->notEmptyDate('nascimento');

        $validator
            ->scalar('sexo')
            ->requirePresence('sexo', 'create')
            ->notEmptyString('sexo');

        $validator
            ->integer('num_animais')
            ->requirePresence('num_animais', 'create')
            ->notEmptyString('num_animais');

        $validator
            ->integer('qtd_saida')
            ->allowEmptyString('qtd_saida');

        $validator
            ->date('ultima_saida')
            ->allowEmptyDate('ultima_saida');

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
        $rules->add($rules->isUnique(['caixa_numero']), ['errorField' => 'caixa_numero']);
        $rules->add($rules->existsIn('linhagem_id', 'Linhagem'), ['errorField' => 'linhagem_id']);
        $rules->add($rules->existsIn('caixa_matriz_id', 'CaixaMatriz'), ['errorField' => 'caixa_matriz_id']);

        return $rules;
    }
}
