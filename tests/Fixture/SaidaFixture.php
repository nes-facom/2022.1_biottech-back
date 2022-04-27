<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SaidaFixture
 */
class SaidaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'saida';
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
                'caixa_id' => 1,
                'data_saida' => '2022-04-27',
                'tipo_saida' => 'Lorem ipsum dolor sit amet',
                'usuario' => 'Lorem ipsum dolor sit amet',
                'num_animais' => 1,
                'saida' => 'Lorem ipsum dolor sit amet',
                'sexo' => 'Lorem ipsum dolor sit amet',
                'sobra' => 1,
                'observacoes' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
