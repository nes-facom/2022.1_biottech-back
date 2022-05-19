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
            "data_acasalamento" => "2022-04-21",
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


    public function testSaveCaixaMatrizWithWrongAttribute()
    {
        $test = new CaixaMatrizService();

        $data = [
            "caixa_matriz_numero" => base64_encode(random_bytes(10)),
            "data_acasalamento" => "2022-03-21",
            "saida_da_colonia" => "2022-03-21",
            "data_obito" => "2022-03-25",
            "caixas" => [
                [
                    "caixa_numero" => "1",
                    "peso" => "afasfasfasf"
                ],
                [
                    "caixa_numero" => "2",
                    "peso" => 10
                ]
            ]
        ];

        $this->expectException(BadRequestException::class);
        $test->saveCaixaMatrizAndUpdate($data, null);
    }

    public function testEditCaixaMatriz()
    {
        $test = new CaixaMatrizService();

        $data = [
            "caixa_matriz_numero" => base64_encode(random_bytes(10)),
            "data_acasalamento" => "2022-04-21",
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

        $this->assertTrue($test->saveCaixaMatrizAndUpdate($data, 1) instanceof CaixaMatriz);

        $this->assertTrue($test->saveCaixaMatrizAndUpdate($data, 1) instanceof CaixaMatriz);
    }

    public function testEditCaixaMatrizWithWrongNumber()
    {
        $test = new CaixaMatrizService();

        $data = [
            "caixa_matriz_numero" => "12345",
            "data_acasalamento" => "2022-04-21",
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
        $this->expectException(BadRequestException::class);
        $test->saveCaixaMatrizAndUpdate($data, 1);

    }

    public function testEditPesquisadorIdNotFound()
    {
        $test = new CaixaMatrizService();

        $data = [
            "caixa_matriz_numero" => base64_encode(random_bytes(10)),
            "data_acasalamento" => "2022-04-21",
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

        $this->expectException(BadRequestException::class);
        $test->saveCaixaMatrizAndUpdate($data, 1000000000);
    }

    public function testGetAllCaixaMatriz()
    {
        $test = new CaixaMatrizService();

        $testGet = $test->getProgamacaoAcasalamento();

        $this->assertTrue($testGet->firstOrFail() instanceof CaixaMatriz);

        $testGet = $test->getMatrizes();

        $this->assertTrue($testGet->firstOrFail() instanceof CaixaMatriz);
    }

}
