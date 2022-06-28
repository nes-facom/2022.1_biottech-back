<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CaixaMatriz extends AbstractMigration
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
        $table = $this->table('caixa_matriz');
        $table->addColumn('caixa_matriz_numero', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('data_acasalamento', 'date', ['null' => false])
            ->addColumn('saida_da_colonia', 'date', ['null' => true])
            ->addColumn('data_obito', 'date', ['null' => true])
            ->addColumn('active', 'boolean', ['default' => true, 'null' => false])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->addIndex(['caixa_matriz_numero'], ['unique' => true])
            ->create();
    }

}
