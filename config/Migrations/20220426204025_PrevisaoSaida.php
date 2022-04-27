<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class PrevisaoSaida extends AbstractMigration
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
         $table = $this->table('previsao_saida');
        $table->addColumn('previsao_id', 'integer')
                ->addColumn('saida_id', 'integer')   
                ->addForeignKey('previsao_id', 'previsao', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->addForeignKey('saida_id', 'saida', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->create();
    }
}
