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
        $table = $this->table('parto_matriz', ['id' => false, 'primary_key' => ['caixa_matriz_id', 'parto_id']]);
        $table->addColumn('caixa_matriz_id', 'integer')
                ->addColumn('parto_id', 'integer')
                ->addForeignKey('caixa_matriz_id', 'caixa_matriz', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('parto_id', 'parto', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->create();
    }

}
