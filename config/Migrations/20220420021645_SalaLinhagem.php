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
        $table = $this->table('sala_linhagem', ['id' => false, 'primary_key' => ['linhagem_id', 'sala_id']]);
        $table->addColumn('linhagem_id', 'integer')
                ->addColumn('sala_id', 'integer')
                ->addForeignKey('linhagem_id', 'linhagem', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('sala_id', 'sala', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->create();
    }

}
