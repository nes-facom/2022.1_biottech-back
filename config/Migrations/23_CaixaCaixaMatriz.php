<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CaixaCaixaMatriz extends AbstractMigration
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
         $table = $this->table('caixa_caixa_matriz');
        $table->addColumn('caixa_matriz_id', 'integer')
                ->addColumn('caixa_id', 'integer')
                ->addColumn('peso', 'float', ['null' => false])
                ->addForeignKey('caixa_matriz_id', 'caixa_matriz', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('caixa_id', 'caixa', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->create();
    }
}
