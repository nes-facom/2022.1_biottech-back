<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * NivelProjetoFixture
 */
class NivelProjetoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'nivel_projeto';
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
                'nome_nivel_projeto' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
