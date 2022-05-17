<?php

namespace App\Test\TestCase\Service;

use App\Model\Entity\Linhagem;
use App\Service\LinhagemService;
use Cake\Http\Exception\BadRequestException;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class LinhagemServiceTest extends TestCase
{

    public function testSaveLinhagem()
    {
        $test = new LinhagemService();

        $data = [
            'nome_linhagem' => base64_encode(random_bytes(10)),
        ];

        $this->assertTrue($test->saveLinhagemAndUpdate($data, null) instanceof Linhagem);

        $this->expectException(BadRequestException::class);
        $test->saveLinhagemAndUpdate($data, null);
    }

    public function testSaveLinhagemUniqueEqualsNull()
    {
        $test = new LinhagemService();

        $data = [
            'nome_especie' => null,
        ];

        $this->expectException(BadRequestException::class);
        $test->saveLinhagemAndUpdate($data, null);
    }

    public function testEditLinhagem()
    {
        $test = new LinhagemService();

        $data = [
            'nome_linhagem' => base64_encode(random_bytes(10)),
        ];

        $this->assertTrue($test->saveLinhagemAndUpdate($data, 1) instanceof Linhagem);
    }

    public function testEditLinhagemIdNotFound()
    {
        $test = new LinhagemService();

        $data = [
            'nome_linhagem' => base64_encode(random_bytes(10)),
        ];

        $this->expectException(BadRequestException::class);
        $test->saveLinhagemAndUpdate($data, 1000000000);
    }


}
