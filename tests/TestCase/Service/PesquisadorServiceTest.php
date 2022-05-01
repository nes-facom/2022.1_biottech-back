<?php

namespace App\Test\TestCase\Service;

use App\Service\PesquisadorSerice;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class PesquisadorServiceTest extends TestCase
{
    public function testSavePesquisador()
    {
        $test = new PesquisadorSerice();

        $data = [
            'nome' => base64_encode(random_bytes(10)),
            'instituicao' => base64_encode(random_bytes(10)),
            'setor' => base64_encode(random_bytes(10)),
            'pos' => base64_encode(random_bytes(10)),
            'ramal' => base64_encode(random_bytes(10)),
            'email' => base64_encode(random_bytes(10)),
            'orientador' => true,
            'telefones' => [
                '67959595',
                '5165161'
            ]

        ];
        $testSave = $test->savePesquisador($data);

        $this->assertNotFalse($testSave);
    }
}
