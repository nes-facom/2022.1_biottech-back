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
        $table->addColumn('numero_parto', 'integer', ['null' => false])
                ->addColumn('data_parto', 'date', ['null' => false])
                ->addColumn('num_macho', 'integer', ['null' => false])
                ->addColumn('num_femea', 'integer', ['null' => false])
                ->addColumn('des_macho', 'integer', ['null' => false])
                ->addColumn('des_femea', 'integer', ['null' => false])
                ->addColumn('qtd_canib', 'integer', ['null' => false])
                ->addColumn('qtd_gamba', 'integer', ['null' => false])
                ->addColumn('qtd_outros', 'integer', ['null' => true])
                ->create();
    }

}
