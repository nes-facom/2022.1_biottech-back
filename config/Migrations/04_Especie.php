<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Especie extends AbstractMigration
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
        $table = $this->table('especie');
        $table->addColumn('nome_especie', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('active', 'boolean', ['default' => true, 'null' => false])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->addIndex(['nome_especie'], ['unique' => true])
            ->create();
    }

}
