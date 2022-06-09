<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Previsao extends AbstractMigration
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
        $table = $this->table('previsao');
        $table->addColumn('pedido_id', 'integer', ['null' => true])
            ->addColumn('num_previsao', 'integer', ['null' => false])
            ->addColumn('retirada_num', 'integer', ['null' => false])
            ->addColumn('qtd_retirar', 'integer', ['null' => false])
            ->addColumn('retirada_data', 'date', ['null' => false])
            ->addColumn('status', 'enum', [
                'values' => ['aberto', 'fechado'], 'null' => false
            ])
            ->addColumn('totalRetirado', 'integer', ['null' => false, 'default' => 0])
            ->addColumn('active', 'boolean', ['default' => true, 'null' => false])
            ->addForeignKey('pedido_id', 'pedido', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addIndex(['num_previsao'], ['unique' => true])
            ->create();
    }

}
