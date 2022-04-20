<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Sala extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('sala');
        $table->addColumn('id_linhagem', 'integer')
                ->addColumn('num_sala', 'integer', ['null' => false])
                ->addForeignKey('id_linhagem', 'linhagem', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addIndex(['num_sala'], ['unique' => true])
                ->create();
    }

}
