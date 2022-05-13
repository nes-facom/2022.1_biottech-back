<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class SubLinhaPesquisaLinhaPesquisa extends AbstractMigration
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
        $table = $this->table('sub_linha_pesquisa_linha_pesquisa');
        $table->addColumn('sub_linha_pesquisa_id', 'integer')
            ->addColumn('linha_pesquisa_id', 'integer')
            ->addForeignKey('sub_linha_pesquisa_id', 'sub_linha_pesquisa', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('linha_pesquisa_id', 'linha_pesquisa', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->create();
    }
}
