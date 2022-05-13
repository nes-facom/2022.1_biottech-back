<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SubLinhaPesquisaLinhaPesquisa Model
 *
 * @property \App\Model\Table\SubLinhaPesquisaTable&\Cake\ORM\Association\BelongsTo $SubLinhaPesquisa
 * @property \App\Model\Table\LinhaPesquisaTable&\Cake\ORM\Association\BelongsTo $LinhaPesquisa
 *
 * @method \App\Model\Entity\SubLinhaPesquisaLinhaPesquisa newEmptyEntity()
 * @method \App\Model\Entity\SubLinhaPesquisaLinhaPesquisa newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisaLinhaPesquisa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisaLinhaPesquisa get($primaryKey, $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisaLinhaPesquisa findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisaLinhaPesquisa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisaLinhaPesquisa[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisaLinhaPesquisa|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisaLinhaPesquisa saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisaLinhaPesquisa[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisaLinhaPesquisa[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisaLinhaPesquisa[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SubLinhaPesquisaLinhaPesquisa[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SubLinhaPesquisaLinhaPesquisaTable extends Table
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

        $this->setTable('sub_linha_pesquisa_linha_pesquisa');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('SubLinhaPesquisa', [
            'foreignKey' => 'sub_linha_pesquisa_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('LinhaPesquisa', [
            'foreignKey' => 'linha_pesquisa_id',
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
            ->integer('sub_linha_pesquisa_id')
            ->requirePresence('sub_linha_pesquisa_id', 'create')
            ->notEmptyString('sub_linha_pesquisa_id');

        $validator
            ->integer('linha_pesquisa_id')
            ->requirePresence('linha_pesquisa_id', 'create')
            ->notEmptyString('linha_pesquisa_id');

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
        $rules->add($rules->existsIn('sub_linha_pesquisa_id', 'SubLinhaPesquisa'), ['errorField' => 'sub_linha_pesquisa_id']);
        $rules->add($rules->existsIn('linha_pesquisa_id', 'LinhaPesquisa'), ['errorField' => 'linha_pesquisa_id']);

        return $rules;
    }
}
