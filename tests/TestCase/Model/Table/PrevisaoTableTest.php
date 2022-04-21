<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PrevisaoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PrevisaoTable Test Case
 */
class PrevisaoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PrevisaoTable
     */
    protected $Previsao;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Previsao',
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
        $config = $this->getTableLocator()->exists('Previsao') ? [] : ['className' => PrevisaoTable::class];
        $this->Previsao = $this->getTableLocator()->get('Previsao', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Previsao);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PrevisaoTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PrevisaoTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
