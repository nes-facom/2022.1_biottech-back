<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Previsao Model
 *
 * @property \App\Model\Table\PedidoTable&\Cake\ORM\Association\BelongsTo $Pedido
 * @property \App\Model\Table\SaidaTable&\Cake\ORM\Association\BelongsToMany $Saida
 *
 * @method \App\Model\Entity\Previsao newEmptyEntity()
 * @method \App\Model\Entity\Previsao newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Previsao[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Previsao get($primaryKey, $options = [])
 * @method \App\Model\Entity\Previsao findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Previsao patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Previsao[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Previsao|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Previsao saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Previsao[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Previsao[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Previsao[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Previsao[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PrevisaoTable extends Table
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

        $this->setTable('previsao');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Pedido', [
            'foreignKey' => 'pedido_id',
        ]);
        $this->belongsToMany('Saida', [
            'foreignKey' => 'previsao_id',
            'targetForeignKey' => 'saida_id',
            'joinTable' => 'previsao_saida',
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
            ->integer('pedido_id')
            ->allowEmptyString('pedido_id');

        $validator
            ->integer('num_previsao')
            ->requirePresence('num_previsao', 'create')
            ->notEmptyString('num_previsao')
            ->add('num_previsao', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('retirada_num')
            ->maxLength('retirada_num', 255)
            ->requirePresence('retirada_num', 'create')
            ->notEmptyString('retirada_num');

        $validator
            ->integer('qtd_retirar')
            ->requirePresence('qtd_retirar', 'create')
            ->notEmptyString('qtd_retirar');

        $validator
            ->date('retirada_data')
            ->requirePresence('retirada_data', 'create')
            ->notEmptyDate('retirada_data');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

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
        $rules->add($rules->isUnique(['num_previsao']), ['errorField' => 'num_previsao']);
        $rules->add($rules->existsIn('pedido_id', 'Pedido'), ['errorField' => 'pedido_id']);

        return $rules;
    }
}
