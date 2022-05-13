<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SubLinhaPesquisa Model
 *
 * @property \App\Model\Table\LinhaPesquisaTable&\Cake\ORM\Association\BelongsToMany $LinhaPesquisa
 *
 * @method \App\Model\Entity\SubLinhaPesquisa newEmptyEntity()
 * @method \App\Model\Entity\SubLinhaPesquisa newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisa get($primaryKey, $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisa findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisa[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisa|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisa saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisa[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisa[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisa[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisa[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SubLinhaPesquisaTable extends Table
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

        $this->setTable('sub_linha_pesquisa');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsToMany('LinhaPesquisa', [
            'foreignKey' => 'sub_linha_pesquisa_id',
            'targetForeignKey' => 'linha_pesquisa_id',
            'joinTable' => 'sub_linha_pesquisa_linha_pesquisa',
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
            ->scalar('nome_sub_linha_pesquisa')
            ->maxLength('nome_sub_linha_pesquisa', 255)
            ->requirePresence('nome_sub_linha_pesquisa', 'create')
            ->notEmptyString('nome_sub_linha_pesquisa')
            ->add('nome_sub_linha_pesquisa', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['nome_sub_linha_pesquisa']), ['errorField' => 'nome_sub_linha_pesquisa']);

        return $rules;
    }
}
