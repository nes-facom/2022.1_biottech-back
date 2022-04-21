<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CaixaMatrizTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CaixaMatrizTable Test Case
 */
class CaixaMatrizTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CaixaMatrizTable
     */
    protected $CaixaMatriz;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.CaixaMatriz',
        'app.Caixa',
        'app.PartoMatriz',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CaixaMatriz') ? [] : ['className' => CaixaMatrizTable::class];
        $this->CaixaMatriz = $this->getTableLocator()->get('CaixaMatriz', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CaixaMatriz);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CaixaMatrizTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CaixaMatrizTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
