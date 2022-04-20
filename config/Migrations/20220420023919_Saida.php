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
        $table->addColumn('id_caixa', 'integer')
                ->addColumn('data_saida', 'date', ['null' => false])
                ->addColumn('tipo_ocorrencia', 'enum', [
                    'values' => ['fornecimento', 'acasalamento', 'eutanasia', 'obito', 'controle_sanitário'], 'null' => false
                ])
                ->addColumn('usuario', 'string', ['limit' => 255, 'null' => true])
                ->addColumn('num_animais', 'integer', ['null' => false])
                ->addColumn('saida', 'enum', [
                    'values' => ['u', 's'], 'null' => false
                ])
                ->addColumn('sexo', 'enum', [
                    'values' => ['macho', 'femea'], 'null' => false
                ])
                ->addColumn('sobra', 'integer', ['null' => false])
                ->addColumn('observacoes', 'string', ['limit' => 255, 'null' => true])
                ->addForeignKey('id_caixa', 'caixa', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
                ->create();
    }
}
