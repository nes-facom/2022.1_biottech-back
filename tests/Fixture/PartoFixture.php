<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PartoFixture
 */
class PartoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'parto';
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
                'numero_parto' => 1,
                'data_parto' => '2022-04-29',
                'num_macho' => 1,
                'num_femea' => 1,
                'des_macho' => 1,
                'des_femea' => 1,
                'qtd_canib' => 1,
                'qtd_gamba' => 1,
                'qtd_outros' => 1,
            ],
        ];
        parent::init();
    }
}
