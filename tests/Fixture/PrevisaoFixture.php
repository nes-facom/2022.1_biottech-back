<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PrevisaoFixture
 */
class PrevisaoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'previsao';
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
                'pedido_id' => 1,
                'num_previsao' => 1,
                'retirada_num' => 1,
                'qtd_retirar' => 1,
                'retirada_data' => '2022-06-09',
                'status' => 'Lorem ipsum dolor sit amet',
                'totalRetirado' => 1,
                'active' => 1,
            ],
        ];
        parent::init();
    }
}
