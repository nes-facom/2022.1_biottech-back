<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VinculoInstitucionalFixture
 */
class VinculoInstitucionalFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'vinculo_institucional';
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
                'nome_vinculo_institucional' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
