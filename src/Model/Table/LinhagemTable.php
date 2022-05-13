<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Linhagem Model
 *
 * @property \App\Model\Table\CaixaTable&\Cake\ORM\Association\HasMany $Caixa
 * @property \App\Model\Table\PedidoTable&\Cake\ORM\Association\HasMany $Pedido
 * @property \App\Model\Table\SalaTable&\Cake\ORM\Association\BelongsToMany $Sala
 *
 * @method \App\Model\Entity\Linhagem newEmptyEntity()
 * @method \App\Model\Entity\Linhagem newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Linhagem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Linhagem get($primaryKey, $options = [])
 * @method \App\Model\Entity\Linhagem findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Linhagem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Linhagem[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Linhagem|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Linhagem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Linhagem[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Linhagem[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Linhagem[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Linhagem[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LinhagemTable extends Table
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

        $this->setTable('linhagem');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Caixa', [
            'foreignKey' => 'linhagem_id',
        ]);
        $this->hasMany('Pedido', [
            'foreignKey' => 'linhagem_id',
        ]);
        $this->belongsToMany('Sala', [
            'foreignKey' => 'linhagem_id',
            'targetForeignKey' => 'sala_id',
            'joinTable' => 'sala_linhagem',
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
            ->scalar('nome_linhagem')
            ->maxLength('nome_linhagem', 255)
            ->requirePresence('nome_linhagem', 'create')
            ->notEmptyString('nome_linhagem')
            ->add('nome_linhagem', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['nome_linhagem']), ['errorField' => 'nome_linhagem']);

        return $rules;
    }
}
