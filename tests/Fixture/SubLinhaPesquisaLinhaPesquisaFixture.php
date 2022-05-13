<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SubLinhaPesquisaLinhaPesquisaFixture
 */
class SubLinhaPesquisaLinhaPesquisaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'sub_linha_pesquisa_linha_pesquisa';
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
                'sub_linha_pesquisa_id' => 1,
                'linha_pesquisa_id' => 1,
            ],
        ];
        parent::init();
    }
}
