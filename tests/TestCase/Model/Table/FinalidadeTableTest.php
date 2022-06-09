<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FinalidadeTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FinalidadeTable Test Case
 */
class FinalidadeTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FinalidadeTable
     */
    protected $Finalidade;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Finalidade',
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
        $config = $this->getTableLocator()->exists('Finalidade') ? [] : ['className' => FinalidadeTable::class];
        $this->Finalidade = $this->getTableLocator()->get('Finalidade', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Finalidade);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FinalidadeTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FinalidadeTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
