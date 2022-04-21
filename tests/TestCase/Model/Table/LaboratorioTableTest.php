<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LaboratorioTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LaboratorioTable Test Case
 */
class LaboratorioTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LaboratorioTable
     */
    protected $Laboratorio;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Laboratorio',
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
        $config = $this->getTableLocator()->exists('Laboratorio') ? [] : ['className' => LaboratorioTable::class];
        $this->Laboratorio = $this->getTableLocator()->get('Laboratorio', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Laboratorio);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LaboratorioTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LaboratorioTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
