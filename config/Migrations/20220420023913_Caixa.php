<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Caixa extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('caixa');
        $table->addColumn('id_linhagem', 'integer')
                ->addColumn('id_caixa_matriz_origem', 'integer')
                ->addColumn('caixa_numero', 'string', ['limit' => 255, 'null' => false])
                ->addColumn('nascimento', 'date', ['null' => false])
                ->addColumn('sexo', 'enum', [
                    'values' => ['macho', 'femea'], 'null' => false
                ])
                ->addColumn('num_animais', 'integer', ['null' => false])
                ->addColumn('saida', 'integer', ['null' => false])
                ->addColumn('ultima_saida', 'date', ['null' => false])
                ->addForeignKey('id_linhagem', 'linhagem', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addIndex(['caixa_numero'], ['unique' => true])
                ->create();
    }

}
