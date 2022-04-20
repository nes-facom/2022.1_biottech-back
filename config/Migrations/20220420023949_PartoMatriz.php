<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class PartoMatriz extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('parto_matriz', ['id' => false, 'primary_key' => ['id_caixa_matriz', 'id_parto']]);
        $table->addColumn('id_caixa_matriz', 'integer')
                ->addColumn('id_parto', 'integer')
                ->addForeignKey('id_caixa_matriz', 'caixa_matriz', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('id_parto', 'parto', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->create();
    }

}
