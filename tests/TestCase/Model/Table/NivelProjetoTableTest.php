<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NivelProjetoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NivelProjetoTable Test Case
 */
class NivelProjetoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\NivelProjetoTable
     */
    protected $NivelProjeto;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.NivelProjeto',
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
        $config = $this->getTableLocator()->exists('NivelProjeto') ? [] : ['className' => NivelProjetoTable::class];
        $this->NivelProjeto = $this->getTableLocator()->get('NivelProjeto', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->NivelProjeto);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\NivelProjetoTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\NivelProjetoTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
