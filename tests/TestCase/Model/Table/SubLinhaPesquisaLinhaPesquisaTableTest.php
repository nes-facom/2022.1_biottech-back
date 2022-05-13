<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubLinhaPesquisaLinhaPesquisaTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubLinhaPesquisaLinhaPesquisaTable Test Case
 */
class SubLinhaPesquisaLinhaPesquisaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SubLinhaPesquisaLinhaPesquisaTable
     */
    protected $SubLinhaPesquisaLinhaPesquisa;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.SubLinhaPesquisaLinhaPesquisa',
        'app.SubLinhaPesquisa',
        'app.LinhaPesquisa',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SubLinhaPesquisaLinhaPesquisa') ? [] : ['className' => SubLinhaPesquisaLinhaPesquisaTable::class];
        $this->SubLinhaPesquisaLinhaPesquisa = $this->getTableLocator()->get('SubLinhaPesquisaLinhaPesquisa', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SubLinhaPesquisaLinhaPesquisa);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SubLinhaPesquisaLinhaPesquisaTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SubLinhaPesquisaLinhaPesquisaTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
