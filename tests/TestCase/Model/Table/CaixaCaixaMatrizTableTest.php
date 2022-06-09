<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CaixaCaixaMatrizTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CaixaCaixaMatrizTable Test Case
 */
class CaixaCaixaMatrizTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CaixaCaixaMatrizTable
     */
    protected $CaixaCaixaMatriz;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.CaixaCaixaMatriz',
        'app.CaixaMatriz',
        'app.Caixa',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CaixaCaixaMatriz') ? [] : ['className' => CaixaCaixaMatrizTable::class];
        $this->CaixaCaixaMatriz = $this->getTableLocator()->get('CaixaCaixaMatriz', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CaixaCaixaMatriz);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CaixaCaixaMatrizTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CaixaCaixaMatrizTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
