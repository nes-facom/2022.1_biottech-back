<?php

namespace Service;

use App\Model\Entity\User;
use App\Service\UserService;
use Cake\Http\Exception\BadRequestException;
use Cake\TestSuite\TestCase;
use phpDocumentor\Reflection\Types\Integer;

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

    public function testUpdatePasswordUser()
    {
        $test = new UserService();

        $data = [
            "password" => "123"
        ];

        $this->assertTrue($test->updateUserPassword(1, $data) instanceof User);
    }

    public function testUpdatePasswordUserIdNotFound()
    {
        $test = new UserService();

        $data = [
            "password" => "123"
        ];

        $this->expectException(BadRequestException::class);
        $test->updateUserPassword(10000000000000, $data);
    }

    public function testUpdatePasswordUserWrong()
    {
        $test = new UserService();

        $data = [
            "password" => ""
        ];

        $this->expectException(BadRequestException::class);
        $test->updateUserPassword(1, $data);
    }

    public function testUpdateAvatar()
    {
        $test = new UserService();

        $data = [
            "avatar" => "avatar2"
        ];

        $this->assertTrue($test->updateUserAvatar(1, $data) instanceof User);
    }

    public function testUpdateAvatarWithWrongAttribute()
    {
        $test = new UserService();

        $data = [
            "avatar" => "avatar2"
        ];

        $this->expectException(BadRequestException::class);
        $test->updateUserAvatar(10000000000000, $data);
    }

    public function testGenerateNewPassword()
    {
        $test = new UserService();

        $this->assertIsString($test->generateNewPassword(1));
    }


    public function testGenerateNewPasswordIdNotFound()
    {
        $test = new UserService();

        $this->expectException(BadRequestException::class);
        $test->generateNewPassword(10000000000000000000000000000000);
    }

    public function testUpdateUserActiveAndDisable()
    {
        $test = new UserService();


        $this->assertTrue($test->updateActiveAndDisable(1,true) instanceof User);

    }
}
