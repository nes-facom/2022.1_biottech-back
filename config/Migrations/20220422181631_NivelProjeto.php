<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class NivelProjeto extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('nivel_projeto');
        $table->addColumn('nome_nivel_projeto', 'string', ['limit' => 255, 'null' => false])
        ->addIndex(['nome_nivel_projeto'], ['unique' => true])     
        ->create();
    }

}
