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
                'caixa_macho_id' => 1,
                'caixa_femea_id' => 1,
                'caixa_matriz_numero' => 'Lorem ipsum dolor sit amet',
                'tipo_acasalamento' => 'Lorem ipsum dolor sit amet',
                'num_femea' => 1,
                'data_acasalamento' => '2022-04-22',
                'intervalo_parto' => 1,
                'peso_macho' => 1.5,
                'peso_femea' => 1.5,
                'saida_da_colonia' => '2022-04-22',
            ],
        ];
        parent::init();
    }
}
