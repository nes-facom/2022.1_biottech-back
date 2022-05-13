<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CaixaFixture
 */
class CaixaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'caixa';
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
                'linhagem_id' => 1,
                'caixa_matriz_id' => 1,
                'caixa_numero' => 'Lorem ipsum dolor sit amet',
                'nascimento' => '2022-05-12',
                'sexo' => 'Lorem ipsum dolor sit amet',
                'num_animais' => 1,
                'qtd_saida' => 1,
                'ultima_saida' => '2022-05-12',
                'active' => 1,
            ],
        ];
        parent::init();
    }
}
