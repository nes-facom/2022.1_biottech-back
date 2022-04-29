<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CaixaTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CaixaTable Test Case
 */
class CaixaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CaixaTable
     */
    protected $Caixa;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Caixa',
        'app.Linhagem',
        'app.CaixaMatriz',
        'app.Saida',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Caixa') ? [] : ['className' => CaixaTable::class];
        $this->Caixa = $this->getTableLocator()->get('Caixa', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Caixa);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CaixaTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CaixaTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
