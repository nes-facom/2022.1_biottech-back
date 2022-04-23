<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Laboratorio extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change() {
        $table = $this->table('laboratorio');
        $table->addColumn('nome_laboratorio', 'string', ['limit' => 255, 'null' => false])
        ->addIndex(['nome_laboratorio'], ['unique' => true])    
        ->create();
    }

}
