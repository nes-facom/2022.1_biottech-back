<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EspecieLinhagemFixture
 */
class EspecieLinhagemFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'especie_linhagem';
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
                'especie_id' => 1,
                'linhagem_id' => 1,
            ],
        ];
        parent::init();
    }
}
