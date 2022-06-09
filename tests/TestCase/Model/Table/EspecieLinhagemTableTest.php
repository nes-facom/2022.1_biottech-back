<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EspecieLinhagemTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EspecieLinhagemTable Test Case
 */
class EspecieLinhagemTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EspecieLinhagemTable
     */
    protected $EspecieLinhagem;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.EspecieLinhagem',
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
        $config = $this->getTableLocator()->exists('EspecieLinhagem') ? [] : ['className' => EspecieLinhagemTable::class];
        $this->EspecieLinhagem = $this->getTableLocator()->get('EspecieLinhagem', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->EspecieLinhagem);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\EspecieLinhagemTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\EspecieLinhagemTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
