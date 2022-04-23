<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Parto extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('parto');
        $table->addColumn('ano_id', 'integer', ['null' => false])
                ->addColumn('caixa_matriz_id', 'integer', ['null' => true])
                ->addColumn('numero_parto', 'integer', ['null' => false])
                ->addColumn('data_parto', 'date', ['null' => false])
                ->addColumn('num_macho', 'integer', ['null' => false])
                ->addColumn('num_femea', 'integer', ['null' => false])
                ->addColumn('des_macho', 'integer', ['null' => false])
                ->addColumn('des_femea', 'integer', ['null' => false])
                ->addColumn('qtd_canib', 'integer', ['null' => false])
                ->addColumn('qtd_gamba', 'integer', ['null' => false])
                ->addColumn('qtd_outros', 'integer', ['null' => true])
                ->addForeignKey('caixa_matriz_id', 'caixa_matriz', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('ano_id', 'ano', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->create();
    }

}
