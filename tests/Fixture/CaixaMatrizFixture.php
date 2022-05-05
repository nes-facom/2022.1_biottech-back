<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CaixaMatrizFixture
 */
class CaixaMatrizFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'caixa_matriz';
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
                'caixa_matriz_numero' => 'Lorem ipsum dolor sit amet',
                'data_acasalamento' => '2022-05-05',
                'saida_da_colonia' => '2022-05-05',
                'data_obito' => '2022-05-05',
            ],
        ];
        parent::init();
    }
}
