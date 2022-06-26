<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Caixa extends AbstractMigration
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
        $table = $this->table('caixa');
        $table->addColumn('linhagem_id', 'integer', ['null' => false])
            ->addColumn('caixa_matriz_id', 'integer', ['null' => true])
            ->addColumn('caixa_numero', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('nascimento', 'date', ['null' => false])
            ->addColumn('sexo', 'enum', [
                'values' => ['macho', 'femea'], 'null' => false
            ])
            ->addColumn('num_animais', 'integer', ['null' => false])
            ->addColumn('qtd_saida', 'integer', ['null' => true])
            ->addColumn('ultima_saida', 'date', ['null' => true])
            ->addColumn('active', 'boolean', ['default' => true, 'null' => false])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->addForeignKey('linhagem_id', 'linhagem', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addIndex(['caixa_numero'], ['unique' => true])
            ->create();
    }

}
