<?php

namespace App\Test\TestCase\Service;

use App\Model\Entity\Pesquisador;
use App\Service\PesquisadorService;
use Cake\Http\Exception\BadRequestException;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class PesquisadorServiceTest extends TestCase
{
    public function testSavePesquisador()
    {
        $test = new PesquisadorService();

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

        $this->assertTrue($test->savePesquisadorUpdate($data, null) instanceof Pesquisador);

        $this->expectException(BadRequestException::class);
        $test->savePesquisadorUpdate($data, null);
    }

    public function testSavePesquisadorWithTelefoneEqualsNull()
    {
        $test = new PesquisadorService();

        $data = [
            'nome' => base64_encode(random_bytes(10)),
            'instituicao' => base64_encode(random_bytes(10)),
            'setor' => base64_encode(random_bytes(10)),
            'pos' => base64_encode(random_bytes(10)),
            'ramal' => base64_encode(random_bytes(10)),
            'email' => base64_encode(random_bytes(10)),
            'orientador' => true,
            'telefones' => []
        ];

        $this->expectException(BadRequestException::class);
        $test->savePesquisadorUpdate($data, null);
    }

    public function testSavePesquisadorWithWrongAttribute()
    {
        $test = new PesquisadorService();

        $data = [
            'nome' => base64_encode(random_bytes(10)),
            'instituicao' => base64_encode(random_bytes(10)),
            'setor' => base64_encode(random_bytes(10)),
            'pos' => base64_encode(random_bytes(10)),
            'ramal' => base64_encode(random_bytes(10)),
            'email' => base64_encode(random_bytes(10)),
            'orientador' => 25,
            'telefones' => [
                '67959595',
                '5165161'
            ]
        ];

        $this->expectException(BadRequestException::class);
        $test->savePesquisadorUpdate($data, null);
    }

    public function testEditPesquisador()
    {
        $test = new PesquisadorService();

        $data = [
            'nome' => base64_encode(random_bytes(10)),
            'instituicao' => base64_encode(random_bytes(10)),
            'setor' => base64_encode(random_bytes(10)),
            'pos' => base64_encode(random_bytes(10)),
            'ramal' => base64_encode(random_bytes(10)),
            'email' => 'leo@gmail.com',
            'orientador' => true,
            'telefones' => [
                '67959595',
                '5165161'
            ]
        ];

        $this->assertTrue($test->savePesquisadorUpdate($data, 1) instanceof Pesquisador);
    }

    public function testEditPesquisadorWithWrongEmail()
    {
        $test = new PesquisadorService();

        $data = [
            'nome' => base64_encode(random_bytes(10)),
            'instituicao' => base64_encode(random_bytes(10)),
            'setor' => base64_encode(random_bytes(10)),
            'pos' => base64_encode(random_bytes(10)),
            'ramal' => base64_encode(random_bytes(10)),
            'email' => 'joana@gmail.com',
            'orientador' => true,
            'telefones' => [
                '67959595',
                '5165161'
            ]
        ];
        $this->expectException(BadRequestException::class);
        $test->savePesquisadorUpdate($data, 1);
    }

    public function testEditPesquisadorIdNotFound()
    {
        $test = new PesquisadorService();

        $data = [
            'nome' => base64_encode(random_bytes(10)),
            'instituicao' => base64_encode(random_bytes(10)),
            'setor' => base64_encode(random_bytes(10)),
            'pos' => base64_encode(random_bytes(10)),
            'ramal' => base64_encode(random_bytes(10)),
            'email' => 'leo@gmail.com',
            'orientador' => true,
            'telefones' => [
                '67959595',
                '5165161'
            ]
        ];

        $this->expectException(BadRequestException::class);
        $test->savePesquisadorUpdate($data, 1000000000);
    }

    public function testGetAllPesquisadores()
    {
        $test = new PesquisadorService();

        $testGet = $test->getPesquisador();

        $this->assertTrue($testGet->firstOrFail() instanceof Pesquisador);
    }
}
