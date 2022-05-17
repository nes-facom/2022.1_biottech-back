<?php

namespace Service;

use App\Model\Entity\CaixaMatriz;
use App\Service\CaixaMatrizService;
use Cake\Http\Exception\BadRequestException;
use Cake\TestSuite\TestCase;

class CaixaMatrizServiceTest extends TestCase
{

    public function testSaveCaixaMatriz()
    {
        $test = new CaixaMatrizService();

        $data = [
            "caixa_matriz_numero" => base64_encode(random_bytes(10)),
            "data_acasalamento" =>  "2022-04-21",
            "saida_da_colonia" => "2022-03-21",
            "data_obito" => "2022-03-25",
            "caixas" => [
                [
                    "caixa_numero" => "1",
                    "peso" => 10
                ],
                [
                    "caixa_numero" => "2",
                    "peso" => 10
                ]
            ]
        ];


        $this->assertTrue($test->saveCaixaMatrizAndUpdate($data, null) instanceof CaixaMatriz);

        $this->expectException(BadRequestException::class);
        $test->saveCaixaMatrizAndUpdate($data, null);
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

        $testGet = $test->getAllPesquisadores();

        $this->assertTrue($testGet->firstOrFail() instanceof Pesquisador);
    }

}
