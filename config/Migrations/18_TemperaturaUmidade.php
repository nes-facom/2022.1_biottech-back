<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class TemperaturaUmidade extends AbstractMigration
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
        $table = $this->table('temperatura_umidade');
        $table->addColumn('sala_id', 'integer', ['null' => true])
            ->addColumn('data', 'date', ['null' => false])
            ->addColumn('temp_matutino', 'float', ['null' => true])
            ->addColumn('ur_matutino', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('temp_vespertino', 'float', ['null' => true])
            ->addColumn('ur_vespertino', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('observacoes', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('active', 'boolean', ['default' => true, 'null' => false])
            ->addForeignKey('sala_id', 'sala', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->create();
    }

}
