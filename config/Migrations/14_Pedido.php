<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Pedido extends AbstractMigration
{

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('pedido');
        $table->addColumn('vinculo_institucional_id', 'integer', ['null' => true])
            ->addColumn('projeto_id', 'integer', ['null' => false])
            ->addColumn('especie_id', 'integer', ['null' => false])
            ->addColumn('linha_pesquisa_id', 'integer', ['null' => true])
            ->addColumn('nivel_projeto_id', 'integer', ['null' => true])
            ->addColumn('laboratorio_id', 'integer', ['null' => true])
            ->addColumn('finalidade_id', 'integer', ['null' => false])
            ->addColumn('pesquisador_id', 'integer', ['null' => false])
            ->addColumn('linhagem_id', 'integer', ['null' => false])
            ->addColumn('processo_sei', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('equipe_executora', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('data_solicitacao', 'date', ['null' => false])
            ->addColumn('titulo', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('especificar', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('exper', 'string',  ['limit' => 255, 'null' => false])
            ->addColumn('num_ceua', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('vigencia_ceua', 'date', ['null' => false])
            ->addColumn('num_aprovado', 'integer', ['null' => false])
            ->addColumn('num_solicitado', 'integer', ['null' => false])
            ->addColumn('adendo_1', 'integer', ['null' => true])
            ->addColumn('adendo_2', 'integer', ['null' => true])
            ->addColumn('sexo', 'enum', [
                'values' => ['macho', 'femea'], 'null' => false
            ])
            ->addColumn('idade', 'integer', ['null' => true])
            ->addColumn('peso', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('observacoes', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('active', 'boolean', ['default' => true, 'null' => false])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->addForeignKey('vinculo_institucional_id', 'vinculo_institucional', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('projeto_id', 'projeto', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('especie_id', 'especie', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('linha_pesquisa_id', 'linha_pesquisa', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('nivel_projeto_id', 'nivel_projeto', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('laboratorio_id', 'laboratorio', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('finalidade_id', 'finalidade', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('pesquisador_id', 'pesquisador', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('linhagem_id', 'linhagem', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->create();
    }

}
