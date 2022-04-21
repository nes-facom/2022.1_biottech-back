<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LaboratorioFixture
 */
class LaboratorioFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'laboratorio';
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
                'nome_laboratorio' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
