<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PrevisaoSaidaFixture
 */
class PrevisaoSaidaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'previsao_saida';
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
                'previsao_id' => 1,
                'saida_id' => 1,
            ],
        ];
        parent::init();
    }
}
