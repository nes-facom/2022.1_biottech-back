<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LinhaPesquisaTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LinhaPesquisaTable Test Case
 */
class LinhaPesquisaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LinhaPesquisaTable
     */
    protected $LinhaPesquisa;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.LinhaPesquisa',
        'app.Pedido',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('LinhaPesquisa') ? [] : ['className' => LinhaPesquisaTable::class];
        $this->LinhaPesquisa = $this->getTableLocator()->get('LinhaPesquisa', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->LinhaPesquisa);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LinhaPesquisaTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LinhaPesquisaTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
