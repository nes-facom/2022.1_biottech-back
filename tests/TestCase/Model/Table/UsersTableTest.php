<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersTable
     */
    protected $Users;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Users') ? [] : ['className' => UsersTable::class];
        $this->Users = $this->getTableLocator()->get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Users);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test saveUser method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::saveUser()
     */
    public function testSaveUser(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getAllUsers method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::getAllUsers()
     */
    public function testGetAllUsers(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test getUser method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::getUser()
     */
    public function testGetUser(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test updateUser method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::updateUser()
     */
    public function testUpdateUser(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test updateUserPassword method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::updateUserPassword()
     */
    public function testUpdateUserPassword(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test updateUserAvatar method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::updateUserAvatar()
     */
    public function testUpdateUserAvatar(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test generateNewPassword method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::generateNewPassword()
     */
    public function testGenerateNewPassword(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test updateActiveAndDisable method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::updateActiveAndDisable()
     */
    public function testUpdateActiveAndDisable(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
