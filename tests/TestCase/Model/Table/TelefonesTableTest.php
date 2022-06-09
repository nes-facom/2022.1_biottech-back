<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TelefonesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TelefonesTable Test Case
 */
class TelefonesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TelefonesTable
     */
    protected $Telefones;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Telefones',
        'app.Pesquisador',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Telefones') ? [] : ['className' => TelefonesTable::class];
        $this->Telefones = $this->getTableLocator()->get('Telefones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Telefones);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TelefonesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\TelefonesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
