<?php

namespace Service;

use App\Model\Entity\User;
use App\Service\UserService;
use Cake\Http\Exception\BadRequestException;
use Cake\TestSuite\TestCase;

class UserServiceTest extends TestCase
{
    public function testSaveUser()
    {
        $test = new UserService();

        $data = [
            "name" => base64_encode(random_bytes(10)),
            "username" => base64_encode(random_bytes(10)),
            "password" => base64_encode(random_bytes(10)),
            "type" => 0
        ];

        $this->assertTrue($test->saveUser($data) instanceof User);

        $this->expectException(BadRequestException::class);
        $test->saveUser($data);
    }

    public function testSaveUserWithWrongAttribute()
    {
        $test = new UserService();

        $data = [
            "name" => base64_encode(random_bytes(10)),
            "username" => base64_encode(random_bytes(10)),
            "password" => base64_encode(random_bytes(10)),
            "type" => "string"
        ];

        $this->expectException(BadRequestException::class);
        $test->saveUser($data);
    }

    public function testGetAllUser()
    {
        $test = new UserService();

        $testGet = $test->getAllUsers(true, 1);

        $this->assertTrue($testGet->firstOrFail() instanceof User);
    }

    public function testGetUser()
    {
        $test = new UserService();

        $testGet = $test->getUser(1);

        $this->assertTrue($testGet instanceof User);
    }

    public function testGetUserIdNotFound()
    {
        $test = new UserService();

        $this->expectException(BadRequestException::class);
        $test->getUser(1000000000000000);
    }


    public function testUpdateUser()
    {
        $test = new UserService();

        $data = [
            "name" => base64_encode(random_bytes(10)),
            "username" => base64_encode(random_bytes(10)),
            "password" => base64_encode(random_bytes(10)),
            "type" => 0
        ];

        $this->assertTrue($test->updateUser(1, $data) instanceof User);
    }

    public function testUpdateUserIdNotFound()
    {
        $test = new UserService();

        $data = [
            "name" => base64_encode(random_bytes(10)),
            "username" => base64_encode(random_bytes(10)),
            "password" => base64_encode(random_bytes(10)),
            "type" => 0
        ];

        $this->expectException(BadRequestException::class);
        $test->updateUser(100000000000000000, $data);
    }

    public function testUpdateUserWithWrongAttribute()
    {
        $test = new UserService();

        $data = [
            "name" => base64_encode(random_bytes(10)),
            "username" => base64_encode(random_bytes(10)),
            "password" => base64_encode(random_bytes(10)),
            "type" => "string"
        ];
        $this->expectException(BadRequestException::class);
        $test->updateUser(1, $data);
    }

}
