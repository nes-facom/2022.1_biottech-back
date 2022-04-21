<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProjetoFixture
 */
class ProjetoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'projeto';
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
                'nome_projeto' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
