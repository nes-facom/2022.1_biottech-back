<?php

namespace App\Test\TestCase\Service;

use App\Service\LinhagemService;
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
        $testSave = $test->saveLinhagem($data);

        $this->assertNotFalse($testSave);
    }


}
