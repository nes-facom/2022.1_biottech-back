<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CaixaMatriz extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('caixa_matriz');
        $table->addColumn('id_caixa_macho', 'integer')
                ->addColumn('id_caixa_femea', 'integer')
                ->addColumn('caixa_matriz_numero', 'string', ['limit' => 255, 'null' => false])
                ->addColumn('tipo_acasalamento', 'string', ['limit' => 255, 'null' => false])
                ->addColumn('num_femea', 'integer', ['null' => false])
                ->addColumn('data_acasalamento', 'date', ['null' => false])
                ->addColumn('intervalo_parto', 'integer', ['null' => false])
                ->addColumn('peso_macho', 'decimal', ['null' => false])
                ->addColumn('peso_femea', 'decimal', ['null' => false])
                ->addColumn('saida_da_colonia', 'date', ['null' => false])
                ->addForeignKey('id_caixa_macho', 'caixa', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('id_caixa_femea', 'caixa', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addIndex(['caixa_matriz_numero'], ['unique' => true])
                ->create();
    }

}
