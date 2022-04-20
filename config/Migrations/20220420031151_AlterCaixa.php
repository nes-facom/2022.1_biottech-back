<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterCaixa extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('caixa');
        $table->addForeignKey('id_caixa_matriz_origem', 'caixa_matriz', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE']);
        $table->update();
    }

}
