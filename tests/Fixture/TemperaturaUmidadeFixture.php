<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TemperaturaUmidadeFixture
 */
class TemperaturaUmidadeFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'temperatura_umidade';
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
                'sala_id' => 1,
                'data' => '2022-06-09',
                'temp_matutino' => 1,
                'ur_matutino' => 'Lorem ipsum dolor sit amet',
                'temp_vespertino' => 1,
                'ur_vespertino' => 'Lorem ipsum dolor sit amet',
                'observacoes' => 'Lorem ipsum dolor sit amet',
                'active' => 1,
            ],
        ];
        parent::init();
    }
}
