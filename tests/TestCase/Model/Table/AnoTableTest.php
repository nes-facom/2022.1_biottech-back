<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AnoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AnoTable Test Case
 */
class AnoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AnoTable
     */
    protected $Ano;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Ano',
        'app.Caixa',
        'app.Parto',
        'app.Pedido',
        'app.Saida',
        'app.TemperaturaUmidade',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Ano') ? [] : ['className' => AnoTable::class];
        $this->Ano = $this->getTableLocator()->get('Ano', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Ano);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AnoTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
