<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class SalaLinhagem extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('sala_linhagem', ['id' => false, 'primary_key' => ['id_linhagem', 'id_sala']]);
        $table->addColumn('id_linhagem', 'integer')
                ->addColumn('id_sala', 'integer')
                ->addForeignKey('id_linhagem', 'linhagem', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('id_sala', 'sala', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->create();
    }

}
