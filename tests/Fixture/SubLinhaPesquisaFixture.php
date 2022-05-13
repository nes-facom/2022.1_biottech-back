<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SubLinhaPesquisaFixture
 */
class SubLinhaPesquisaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'sub_linha_pesquisa';
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
                'nome_sub_linha_pesquisa' => 'Lorem ipsum dolor sit amet',
                'active' => 1,
            ],
        ];
        parent::init();
    }
}
