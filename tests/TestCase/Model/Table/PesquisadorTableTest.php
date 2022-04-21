<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PesquisadorTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PesquisadorTable Test Case
 */
class PesquisadorTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PesquisadorTable
     */
    protected $Pesquisador;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Pesquisador',
        'app.Pedido',
        'app.Telefones',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Pesquisador') ? [] : ['className' => PesquisadorTable::class];
        $this->Pesquisador = $this->getTableLocator()->get('Pesquisador', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Pesquisador);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PesquisadorTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PesquisadorTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
