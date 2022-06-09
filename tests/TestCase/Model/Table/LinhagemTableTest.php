<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LinhagemTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LinhagemTable Test Case
 */
class LinhagemTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LinhagemTable
     */
    protected $Linhagem;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Linhagem',
        'app.Caixa',
        'app.Pedido',
        'app.Especie',
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
        $config = $this->getTableLocator()->exists('Linhagem') ? [] : ['className' => LinhagemTable::class];
        $this->Linhagem = $this->getTableLocator()->get('Linhagem', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Linhagem);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LinhagemTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LinhagemTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
