<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AnoFixture
 */
class AnoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'ano';
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
                'ano' => 1,
            ],
        ];
        parent::init();
    }
}
