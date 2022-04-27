<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TemperaturaUmidadeTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TemperaturaUmidadeTable Test Case
 */
class TemperaturaUmidadeTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TemperaturaUmidadeTable
     */
    protected $TemperaturaUmidade;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.TemperaturaUmidade',
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
        $config = $this->getTableLocator()->exists('TemperaturaUmidade') ? [] : ['className' => TemperaturaUmidadeTable::class];
        $this->TemperaturaUmidade = $this->getTableLocator()->get('TemperaturaUmidade', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TemperaturaUmidade);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TemperaturaUmidadeTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\TemperaturaUmidadeTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
