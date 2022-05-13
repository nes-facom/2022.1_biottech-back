<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Linhagem extends AbstractMigration
{

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('linhagem');
        $table->addColumn('nome_linhagem', 'string', ['limit' => 255, 'null' => false])
            ->addIndex(['nome_linhagem'], ['unique' => true])
            ->addColumn('active', 'boolean', ['default' => true, 'null' => false])
            ->create();
    }

}
