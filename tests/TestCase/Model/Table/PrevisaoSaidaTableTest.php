<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PrevisaoSaidaTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PrevisaoSaidaTable Test Case
 */
class PrevisaoSaidaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PrevisaoSaidaTable
     */
    protected $PrevisaoSaida;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.PrevisaoSaida',
        'app.Previsao',
        'app.Saida',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PrevisaoSaida') ? [] : ['className' => PrevisaoSaidaTable::class];
        $this->PrevisaoSaida = $this->getTableLocator()->get('PrevisaoSaida', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->PrevisaoSaida);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PrevisaoSaidaTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PrevisaoSaidaTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
