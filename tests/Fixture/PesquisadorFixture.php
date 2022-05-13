<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PesquisadorFixture
 */
class PesquisadorFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'pesquisador';
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
                'nome' => 'Lorem ipsum dolor sit amet',
                'instituicao' => 'Lorem ipsum dolor sit amet',
                'setor' => 'Lorem ipsum dolor sit amet',
                'pos' => 'Lorem ipsum dolor sit amet',
                'ramal' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'orientador' => 1,
                'active' => 1,
            ],
        ];
        parent::init();
    }
}
