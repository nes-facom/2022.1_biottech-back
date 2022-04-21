<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PartoMatrizTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PartoMatrizTable Test Case
 */
class PartoMatrizTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PartoMatrizTable
     */
    protected $PartoMatriz;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.PartoMatriz',
        'app.CaixaMatriz',
        'app.Parto',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PartoMatriz') ? [] : ['className' => PartoMatrizTable::class];
        $this->PartoMatriz = $this->getTableLocator()->get('PartoMatriz', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PartoMatriz);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PartoMatrizTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
