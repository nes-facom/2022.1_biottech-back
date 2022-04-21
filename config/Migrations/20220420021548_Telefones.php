<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Telefones extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('telefones');
        $table->addColumn('pesquisador_id', 'integer', ['null' => true])
                ->addColumn('telefone', 'string', ['limit' => 255, 'null' => false])
                ->addForeignKey('pesquisador_id', 'pesquisador', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->create();
    }

}
