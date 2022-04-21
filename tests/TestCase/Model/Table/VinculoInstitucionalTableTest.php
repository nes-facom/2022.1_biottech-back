<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VinculoInstitucionalTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VinculoInstitucionalTable Test Case
 */
class VinculoInstitucionalTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VinculoInstitucionalTable
     */
    protected $VinculoInstitucional;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.VinculoInstitucional',
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
        $config = $this->getTableLocator()->exists('VinculoInstitucional') ? [] : ['className' => VinculoInstitucionalTable::class];
        $this->VinculoInstitucional = $this->getTableLocator()->get('VinculoInstitucional', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->VinculoInstitucional);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\VinculoInstitucionalTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\VinculoInstitucionalTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
