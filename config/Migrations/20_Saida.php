<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class Saida extends AbstractMigration
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
        $table = $this->table('saida');
        $table->addColumn('caixa_id', 'integer', ['null' => true])
            ->addColumn('previsao_id', 'integer', ['null' => true])
            ->addColumn('data_saida', 'date', ['null' => false])
            ->addColumn('tipo_saida', 'enum', [
                'values' => ['fornecimento', 'acasalamento', 'eutanasia', 'obito', 'controle_sanitário'], 'null' => false
            ])
            ->addColumn('usuario', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('num_animais', 'integer', ['null' => false])
            ->addColumn('saida', 'enum', [
                'values' => ['ultima', 'sobra'], 'null' => false
            ])
            ->addColumn('sexo', 'enum', [
                'values' => ['macho', 'femea'], 'null' => false
            ])
            ->addColumn('sobra', 'integer', ['null' => false])
            ->addColumn('observacoes', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('active', 'boolean', ['default' => true, 'null' => false])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->addForeignKey('caixa_id', 'caixa', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->addForeignKey('previsao_id', 'previsao', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
            ->create();
    }
}
