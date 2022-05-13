<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class VinculoInstitucional extends AbstractMigration
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
        $table = $this->table('vinculo_institucional');
        $table->addColumn('nome_vinculo_institucional', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('active', 'boolean', ['default' => true, 'null' => false])
            ->addIndex(['nome_vinculo_institucional'], ['unique' => true])
            ->create();
    }

}
