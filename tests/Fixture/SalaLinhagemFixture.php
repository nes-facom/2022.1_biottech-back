<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SalaLinhagemFixture
 */
class SalaLinhagemFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'sala_linhagem';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'linhagem_id' => 1,
                'sala_id' => 1,
            ],
        ];
        parent::init();
    }
}
