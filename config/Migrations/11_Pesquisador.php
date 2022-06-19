<?php

declare(strict_types=1);

use Cake\I18n\FrozenTime;
use Migrations\AbstractMigration;

class Pesquisador extends AbstractMigration
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
        $table = $this->table('pesquisador');
        $table->addColumn('nome', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('instituicao', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('setor', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('pos', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('ramal', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('email', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('orientador', 'boolean', ['null' => false])
            ->addColumn('active', 'boolean', ['default' => true, 'null' => false])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->addIndex(['email'], ['unique' => true])
            ->create();
    }

}
