<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use App\Utility\PedidosGetRequestBody;

/**
 * Pedido Model
 *
 * @property \App\Model\Table\VinculoInstitucionalTable&\Cake\ORM\Association\BelongsTo $VinculoInstitucional
 * @property \App\Model\Table\ProjetoTable&\Cake\ORM\Association\BelongsTo $Projeto
 * @property \App\Model\Table\EspecieTable&\Cake\ORM\Association\BelongsTo $Especie
 * @property \App\Model\Table\LinhaPesquisaTable&\Cake\ORM\Association\BelongsTo $LinhaPesquisa
 * @property \App\Model\Table\NivelProjetoTable&\Cake\ORM\Association\BelongsTo $NivelProjeto
 * @property \App\Model\Table\LaboratorioTable&\Cake\ORM\Association\BelongsTo $Laboratorio
 * @property \App\Model\Table\FinalidadeTable&\Cake\ORM\Association\BelongsTo $Finalidade
 * @property \App\Model\Table\PesquisadorTable&\Cake\ORM\Association\BelongsTo $Pesquisador
 * @property \App\Model\Table\LinhagemTable&\Cake\ORM\Association\BelongsTo $Linhagem
 * @property \App\Model\Table\PrevisaoTable&\Cake\ORM\Association\HasMany $Previsao
 *
 * @method \App\Model\Entity\Pedido newEmptyEntity()
 * @method \App\Model\Entity\Pedido newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Pedido[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pedido get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pedido findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Pedido patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pedido[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pedido|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pedido saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Pedido[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PedidoTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void {
        parent::initialize($config);

        $this->setTable('pedido');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('VinculoInstitucional', [
            'foreignKey' => 'vinculo_institucional_id',
        ]);
        $this->belongsTo('Projeto', [
            'foreignKey' => 'projeto_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Especie', [
            'foreignKey' => 'especie_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('LinhaPesquisa', [
            'foreignKey' => 'linha_pesquisa_id',
        ]);
        $this->belongsTo('NivelProjeto', [
            'foreignKey' => 'nivel_projeto_id',
        ]);
        $this->belongsTo('Laboratorio', [
            'foreignKey' => 'laboratorio_id',
        ]);
        $this->belongsTo('Finalidade', [
            'foreignKey' => 'finalidade_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Pesquisador', [
            'foreignKey' => 'pesquisador_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Linhagem', [
            'foreignKey' => 'linhagem_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Previsao', [
            'foreignKey' => 'pedido_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator {
        $validator
                ->integer('vinculo_institucional_id')
                ->allowEmptyString('vinculo_institucional_id');

        $validator
                ->integer('projeto_id')
                ->requirePresence('projeto_id', 'create')
                ->notEmptyString('projeto_id');

        $validator
                ->integer('especie_id')
                ->requirePresence('especie_id', 'create')
                ->notEmptyString('especie_id');

        $validator
                ->integer('linha_pesquisa_id')
                ->allowEmptyString('linha_pesquisa_id');

        $validator
                ->integer('nivel_projeto_id')
                ->allowEmptyString('nivel_projeto_id');

        $validator
                ->integer('laboratorio_id')
                ->allowEmptyString('laboratorio_id');

        $validator
                ->integer('finalidade_id')
                ->requirePresence('finalidade_id', 'create')
                ->notEmptyString('finalidade_id');

        $validator
                ->integer('pesquisador_id')
                ->requirePresence('pesquisador_id', 'create')
                ->notEmptyString('pesquisador_id');

        $validator
                ->integer('linhagem_id')
                ->requirePresence('linhagem_id', 'create')
                ->notEmptyString('linhagem_id');

        $validator
                ->integer('num_previsao')
                ->requirePresence('num_previsao', 'create')
                ->notEmptyString('num_previsao')
                ->add('num_previsao', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
                ->scalar('processo_sei')
                ->maxLength('processo_sei', 255)
                ->requirePresence('processo_sei', 'create')
                ->notEmptyString('processo_sei');

        $validator
                ->scalar('equipe_executora')
                ->maxLength('equipe_executora', 255)
                ->requirePresence('equipe_executora', 'create')
                ->notEmptyString('equipe_executora');

        $validator
                ->date('data_solicitacao')
                ->requirePresence('data_solicitacao', 'create')
                ->notEmptyDate('data_solicitacao');

        $validator
                ->scalar('titulo')
                ->maxLength('titulo', 255)
                ->requirePresence('titulo', 'create')
                ->notEmptyString('titulo');

        $validator
                ->scalar('especificar')
                ->maxLength('especificar', 255)
                ->requirePresence('especificar', 'create')
                ->notEmptyString('especificar');

        $validator
                ->integer('exper')
                ->requirePresence('exper', 'create')
                ->notEmptyString('exper');

        $validator
                ->scalar('num_ceua')
                ->maxLength('num_ceua', 255)
                ->requirePresence('num_ceua', 'create')
                ->notEmptyString('num_ceua');

        $validator
                ->date('vigencia_ceua')
                ->requirePresence('vigencia_ceua', 'create')
                ->notEmptyDate('vigencia_ceua');

        $validator
                ->integer('num_aprovado')
                ->requirePresence('num_aprovado', 'create')
                ->notEmptyString('num_aprovado');

        $validator
                ->integer('num_solicitado')
                ->requirePresence('num_solicitado', 'create')
                ->notEmptyString('num_solicitado');

        $validator
                ->integer('adendo_1')
                ->requirePresence('adendo_1', 'create')
                ->notEmptyString('adendo_1');

        $validator
                ->integer('adendo_2')
                ->requirePresence('adendo_2', 'create')
                ->notEmptyString('adendo_2');

        $validator
                ->scalar('sexo')
                ->requirePresence('sexo', 'create')
                ->notEmptyString('sexo');

        $validator
                ->scalar('idade')
                ->maxLength('idade', 255)
                ->requirePresence('idade', 'create')
                ->notEmptyString('idade');

        $validator
                ->decimal('peso')
                ->requirePresence('peso', 'create')
                ->notEmptyString('peso');

        $validator
                ->scalar('observacoes')
                ->maxLength('observacoes', 255)
                ->requirePresence('observacoes', 'create')
                ->notEmptyString('observacoes');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker {
        $rules->add($rules->isUnique(['num_previsao']), ['errorField' => 'num_previsao']);
        $rules->add($rules->existsIn('vinculo_institucional_id', 'VinculoInstitucional'), ['errorField' => 'vinculo_institucional_id']);
        $rules->add($rules->existsIn('projeto_id', 'Projeto'), ['errorField' => 'projeto_id']);
        $rules->add($rules->existsIn('especie_id', 'Especie'), ['errorField' => 'especie_id']);
        $rules->add($rules->existsIn('linha_pesquisa_id', 'LinhaPesquisa'), ['errorField' => 'linha_pesquisa_id']);
        $rules->add($rules->existsIn('nivel_projeto_id', 'NivelProjeto'), ['errorField' => 'nivel_projeto_id']);
        $rules->add($rules->existsIn('laboratorio_id', 'Laboratorio'), ['errorField' => 'laboratorio_id']);
        $rules->add($rules->existsIn('finalidade_id', 'Finalidade'), ['errorField' => 'finalidade_id']);
        $rules->add($rules->existsIn('pesquisador_id', 'Pesquisador'), ['errorField' => 'pesquisador_id']);
        $rules->add($rules->existsIn('linhagem_id', 'Linhagem'), ['errorField' => 'linhagem_id']);

        return $rules;
    }

    public function getAllPedidos() {

        // Prior to 3.6 use TableRegistry::get('Articles')
        $pedidoTable = TableRegistry::getTableLocator()->get('Pedido')->find();

        //$queryUser = $usersTable->all();




        $query = $pedidoTable->find('all', ['contain' => ['VinculoInstitucional', 'Projeto', 'Especie', 'LinhaPesquisa'
                , 'NivelProjeto', 'Laboratorio', 'Finalidade', 'Pesquisador', 'Linhagem', 'Previsao']]);
        $newPedidos = array();
        
        foreach ($query as $row) {
            $saldoCEUA = ($row->num_aprovado - $row->num_solicitado) + $row->adendo_1 + $row->adendo_2;
            $newPedido = new PedidosGetRequestBody();
            $newPedido->setId($row->id);
            $newPedido->setAdendo_1($row->adendo_1);
            $newPedido->setAdendo_2($row->adendo_2);
            $newPedido->setData_solicitacao($row->data_solicitacao);
            $newPedido->setEquipe_executora($row->equipe_executora);
            $newPedido->setEspecie($row->especie);
            $newPedido->setEspecificar($row->especificar);
            $newPedido->setExper($row->exper);
            $newPedido->setFinalidade($row->finalidade);
            $newPedido->setIdade($row->idade);
            $newPedido->setLaboratorio($row->laboratorio);
            $newPedido->setLinha_pesquisa($row->linha_pesquisa);
            $newPedido->setLinhagem($row->linhagem);
            $newPedido->setNivel_projeto($row->nivel_projeto);
            $newPedido->setNum_aprovado($row->num_aprovado);
            $newPedido->setNum_ceua($row->num_ceua);
            $newPedido->setNum_previsao($row->num_previsao);
            $newPedido->setNum_solicitado($row->num_solicitado);
            $newPedido->setObservacoes($row->observacoes);
            $newPedido->setPeso($row->peso);
            $newPedido->setPesquisador($row->pesquisador);
            $newPedido->setPrevisao($row->previsao);
            $newPedido->setProcesso_sei($row->processo_sei);
            $newPedido->setProjeto($row->projeto);
            $newPedido->setSaldoCEUA($saldoCEUA);
            //$newPedido->setSaldoPrevisao($row->adento_1);
            $newPedido->setSexo($row->sexo);
            $newPedido->setTitulo($row->titulo);
            //$newPedido->setTotalRetirado($row->adento_1);
            $newPedido->setVigencia_ceua($row->vigencia_ceua);
            $newPedido->setVinculo_institucional($row->vinculo_institucional);
            
            
            
           array_push($newPedidos, $newPedido);
        }
        //$query = $pedidoTable->find('all');
        //$query =   $pedidoTable->all();

        /* $query = $usersTable->all()->contains([
          'Pesquisador'
          ]); */


        return $newPedidos;
    }

}
