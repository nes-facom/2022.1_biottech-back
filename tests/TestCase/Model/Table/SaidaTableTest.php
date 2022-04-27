<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SaidaTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SaidaTable Test Case
 */
class SaidaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SaidaTable
     */
    protected $Saida;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Saida',
        'app.Caixa',
        'app.Previsao',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Saida') ? [] : ['className' => SaidaTable::class];
        $this->Saida = $this->getTableLocator()->get('Saida', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Saida);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SaidaTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SaidaTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
