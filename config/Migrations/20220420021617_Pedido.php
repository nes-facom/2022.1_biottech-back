<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Pedido extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('pedido');
        $table->addColumn('id_vinculo_institucional', 'integer')
                ->addColumn('id_projeto', 'integer')
                ->addColumn('id_especie', 'integer')
                ->addColumn('id_linha_pesquisa', 'integer')
                ->addColumn('id_nivel_projeto', 'integer')
                ->addColumn('id_laboratorio', 'integer')
                ->addColumn('id_finalidade', 'integer')
                ->addColumn('id_pesquisador', 'integer')
                ->addColumn('id_linhagem', 'integer')
                ->addColumn('num_previsao', 'integer', ['null' => false])
                ->addColumn('processo_sei', 'string', ['limit' => 255, 'null' => false])
                ->addColumn('equipe_executora', 'string', ['limit' => 255, 'null' => false])
                ->addColumn('data_solicitacao', 'date', ['null' => false])
                ->addColumn('titulo', 'string', ['limit' => 255, 'null' => false])
                ->addColumn('especificar', 'string', ['limit' => 255, 'null' => false])
                ->addColumn('exper', 'integer', ['null' => false])
                ->addColumn('num_ceua', 'string', ['limit' => 255, 'null' => false])
                ->addColumn('vigencia_ceua', 'date', ['null' => false])
                ->addColumn('num_aprovado', 'integer', ['null' => false])
                ->addColumn('num_solicitado', 'integer', ['null' => false])
                ->addColumn('adendo_1', 'integer', ['null' => false])
                ->addColumn('adendo_2', 'integer', ['null' => false])
                ->addColumn('sexo', 'integer', ['null' => false])
                ->addColumn('idade', 'string', ['limit' => 255, 'null' => false])
                ->addColumn('peso', 'decimal', ['null' => false])
                ->addColumn('observacoes', 'integer', ['null' => false])
                ->addForeignKey('id_vinculo_institucional', 'vinculo_institucional', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('id_projeto', 'projeto', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('id_especie', 'especie', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('id_linha_pesquisa', 'linha_pesquisa', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('id_nivel_projeto', 'nivel_projeto', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('id_laboratorio', 'laboratorio', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('id_finalidade', 'finalidade', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('id_pesquisador', 'pesquisador', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('id_linhagem', 'linhagem', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addIndex(['num_previsao'], ['unique' => true])
                ->create();
    }

}
