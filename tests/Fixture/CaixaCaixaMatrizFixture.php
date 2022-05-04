<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CaixaCaixaMatrizFixture
 */
class CaixaCaixaMatrizFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'caixa_caixa_matriz';
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
                'caixa_matriz_id' => 1,
                'caixa_id' => 1,
                'peso' => 1.5,
            ],
        ];
        parent::init();
    }
}
