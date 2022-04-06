<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\UserServiceComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\UserServiceComponent Test Case
 */
class UserServiceComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\UserServiceComponent
     */
    protected $UserService;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->UserService = new UserServiceComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UserService);

        parent::tearDown();
    }
}
