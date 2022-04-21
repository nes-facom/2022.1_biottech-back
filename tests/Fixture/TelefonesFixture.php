<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TelefonesFixture
 */
class TelefonesFixture extends TestFixture
{
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
                'pesquisador_id' => 1,
                'telefone' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
