<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PartoMatrizFixture
 */
class PartoMatrizFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'parto_matriz';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'caixa_matriz_id' => 1,
                'parto_id' => 1,
            ],
        ];
        parent::init();
    }
}
