<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ano Model
 *
 * @property \App\Model\Table\CaixaTable&\Cake\ORM\Association\HasMany $Caixa
 * @property \App\Model\Table\PartoTable&\Cake\ORM\Association\HasMany $Parto
 * @property \App\Model\Table\PedidoTable&\Cake\ORM\Association\HasMany $Pedido
 * @property \App\Model\Table\SaidaTable&\Cake\ORM\Association\HasMany $Saida
 * @property \App\Model\Table\TemperaturaUmidadeTable&\Cake\ORM\Association\HasMany $TemperaturaUmidade
 *
 * @method \App\Model\Entity\Ano newEmptyEntity()
 * @method \App\Model\Entity\Ano newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Ano[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ano get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ano findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Ano patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ano[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ano|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ano saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ano[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ano[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ano[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Ano[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AnoTable extends Table
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

        $this->setTable('ano');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Caixa', [
            'foreignKey' => 'ano_id',
        ]);
        $this->hasMany('Parto', [
            'foreignKey' => 'ano_id',
        ]);
        $this->hasMany('Pedido', [
            'foreignKey' => 'ano_id',
        ]);
        $this->hasMany('Saida', [
            'foreignKey' => 'ano_id',
        ]);
        $this->hasMany('TemperaturaUmidade', [
            'foreignKey' => 'ano_id',
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
            ->integer('ano')
            ->requirePresence('ano', 'create')
            ->notEmptyString('ano');

        return $validator;
    }
}
