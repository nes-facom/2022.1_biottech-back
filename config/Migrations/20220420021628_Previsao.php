<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Previsao extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('previsao');
        $table->addColumn('id_pedido', 'integer')
                ->addColumn('num_previsao', 'integer', ['null' => false])
                ->addColumn('retirada_num', 'string', ['limit' => 255, 'null' => false])
                ->addColumn('qtd_retirar', 'integer', ['null' => false])
                ->addColumn('retirada_data', 'date', ['null' => true])
                ->addColumn('retirado', 'integer', ['null' => false])
                ->addColumn('status', 'string', ['limit' => 255, 'null' => false])
                ->addForeignKey('id_pedido', 'pedido', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addIndex(['num_previsao'], ['unique' => true])
                ->create();
    }

}
