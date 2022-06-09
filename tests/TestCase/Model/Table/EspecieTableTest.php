<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EspecieTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EspecieTable Test Case
 */
class EspecieTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EspecieTable
     */
    protected $Especie;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Especie',
        'app.Pedido',
        'app.Linhagem',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Especie') ? [] : ['className' => EspecieTable::class];
        $this->Especie = $this->getTableLocator()->get('Especie', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Especie);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\EspecieTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\EspecieTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
