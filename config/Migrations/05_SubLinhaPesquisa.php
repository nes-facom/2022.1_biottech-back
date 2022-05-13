<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class SubLinhaPesquisa extends AbstractMigration
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
        $table = $this->table('sub_linha_pesquisa');
        $table->addColumn('nome_sub_linha_pesquisa', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('active', 'boolean', ['default' => true, 'null' => false])
            ->addIndex(['nome_sub_linha_pesquisa'], ['unique' => true])
            ->create();
    }
}
