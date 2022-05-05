<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'username' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'type' => 1,
                'active' => 1,
                'created' => '2022-05-05 03:06:40',
                'modified' => '2022-05-05 03:06:40',
                'avatar' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
