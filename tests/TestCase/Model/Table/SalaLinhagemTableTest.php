<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SalaLinhagemTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SalaLinhagemTable Test Case
 */
class SalaLinhagemTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SalaLinhagemTable
     */
    protected $SalaLinhagem;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.SalaLinhagem',
        'app.Linhagem',
        'app.Sala',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SalaLinhagem') ? [] : ['className' => SalaLinhagemTable::class];
        $this->SalaLinhagem = $this->getTableLocator()->get('SalaLinhagem', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SalaLinhagem);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SalaLinhagemTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SalaLinhagemTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
