<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class LinhaPesquisa extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('linha_pesquisa');
        $table->addColumn('nome_linha_pesquisa', 'string', ['limit' => 255, 'null' => false])
        ->addIndex(['nome_linha_pesquisa'], ['unique' => true])         
        ->create();
    }

}
