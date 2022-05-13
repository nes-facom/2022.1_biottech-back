<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LinhaPesquisa Model
 *
 * @property \App\Model\Table\PedidoTable&\Cake\ORM\Association\HasMany $Pedido
 *
 * @method \App\Model\Entity\LinhaPesquisa newEmptyEntity()
 * @method \App\Model\Entity\LinhaPesquisa newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LinhaPesquisa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LinhaPesquisa get($primaryKey, $options = [])
 * @method \App\Model\Entity\LinhaPesquisa findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LinhaPesquisa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LinhaPesquisa[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LinhaPesquisa|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LinhaPesquisa saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LinhaPesquisa[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LinhaPesquisa[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LinhaPesquisa[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LinhaPesquisa[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LinhaPesquisaTable extends Table
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

        $this->setTable('linha_pesquisa');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Pedido', [
            'foreignKey' => 'linha_pesquisa_id',
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
            ->scalar('nome_linha_pesquisa')
            ->maxLength('nome_linha_pesquisa', 255)
            ->requirePresence('nome_linha_pesquisa', 'create')
            ->notEmptyString('nome_linha_pesquisa')
            ->add('nome_linha_pesquisa', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['nome_linha_pesquisa']), ['errorField' => 'nome_linha_pesquisa']);

        return $rules;
    }
}
