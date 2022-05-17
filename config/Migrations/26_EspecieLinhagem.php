<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class EspecieLinhagem extends AbstractMigration
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
        $table = $this->table('especie_linhagem');
        $table->addColumn('especie_id', 'integer')
            ->addColumn('linhagem_id', 'integer')
            ->addForeignKey('especie_id', 'sub_linha_pesquisa', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('linhagem_id', 'linha_pesquisa', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->create();
    }
}
