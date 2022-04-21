<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LinhaPesquisaFixture
 */
class LinhaPesquisaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'linha_pesquisa';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'nome_linha_pesquisa' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
