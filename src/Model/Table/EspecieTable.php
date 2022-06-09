<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Especie Model
 *
 * @property \App\Model\Table\PedidoTable&\Cake\ORM\Association\HasMany $Pedido
 * @property \App\Model\Table\LinhagemTable&\Cake\ORM\Association\BelongsToMany $Linhagem
 *
 * @method \App\Model\Entity\Especie newEmptyEntity()
 * @method \App\Model\Entity\Especie newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Especie[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Especie get($primaryKey, $options = [])
 * @method \App\Model\Entity\Especie findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Especie patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Especie[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Especie|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Especie saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Especie[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Especie[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Especie[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Especie[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class EspecieTable extends Table
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

        $this->setTable('especie');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Pedido', [
            'foreignKey' => 'especie_id',
        ]);
        $this->belongsToMany('Linhagem', [
            'foreignKey' => 'especie_id',
            'targetForeignKey' => 'linhagem_id',
            'joinTable' => 'especie_linhagem',
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
            ->scalar('nome_especie')
            ->maxLength('nome_especie', 255)
            ->requirePresence('nome_especie', 'create')
            ->notEmptyString('nome_especie')
            ->add('nome_especie', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['nome_especie']), ['errorField' => 'nome_especie']);

        return $rules;
    }
}
