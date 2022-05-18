<?php

namespace Service;

use App\Model\Entity\Saida;
use App\Service\SaidaService;
use Cake\Http\Exception\BadRequestException;
use Cake\TestSuite\TestCase;

class SaidaServiceTest extends TestCase
{
    public function testSaveSaida()
    {
        $test = new SaidaService();

        $data = [
            "caixa_id" => 1,
            "data_saida" => "2022-03-25",
            "tipo_saida" => "fornecimento",
            "usuario" => base64_encode(random_bytes(10)),
            "num_animais" => rand(10, 15),
            "saida" => "ultima",
            "sexo" => "femea",
            "sobra" => rand(5, 10),
            "observacoes" => base64_encode(random_bytes(10)),
            "previsao_id" => 1
        ];


        $this->assertTrue($test->saveSaidaAndUpdate($data, null) instanceof Saida);

    }

    public function testSaveSaidaWithWrongAttribute()
    {
        $test = new SaidaService();

        $data = [
            "caixa_id" => 1,
            "data_saida" => "2022-03-25",
            "tipo_saida" => "fornecimento",
            "usuario" => base64_encode(random_bytes(10)),
            "num_animais" => "string",
            "saida" => "ultima",
            "sexo" => "femea",
            "sobra" => rand(5, 10),
            "observacoes" => base64_encode(random_bytes(10)),
            "previsao_id" => 1
        ];

        $this->expectException(BadRequestException::class);
        $test->saveSaidaAndUpdate($data, null);
    }

    public function testEditSaida()
    {
        $test = new SaidaService();

        $data = [
            "caixa_id" => 1,
            "data_saida" => "2022-03-25",
            "tipo_saida" => "fornecimento",
            "usuario" => base64_encode(random_bytes(10)),
            "num_animais" => rand(10, 15),
            "saida" => "ultima",
            "sexo" => "femea",
            "sobra" => rand(5, 10),
            "observacoes" => base64_encode(random_bytes(10)),
            "previsao_id" => 1
        ];

        $this->assertTrue($test->saveSaidaAndUpdate($data, 1) instanceof Saida);
    }


    public function testEditSaidaIdNotFound()
    {
        $test = new SaidaService();

        $data = [
            "caixa_id" => 1,
            "data_saida" => "2022-03-25",
            "tipo_saida" => "fornecimento",
            "usuario" => base64_encode(random_bytes(10)),
            "num_animais" => rand(10, 15),
            "saida" => "ultima",
            "sexo" => "femea",
            "sobra" => rand(5, 10),
            "observacoes" => base64_encode(random_bytes(10)),
            "previsao_id" => 1
        ];

        $this->expectException(BadRequestException::class);
        $test->saveSaidaAndUpdate($data, 1000000000);
    }

    public function testGetAllSaida()
    {
        $test = new SaidaService();

        $testGet = $test->getSaida();

        $this->assertTrue($testGet->firstOrFail() instanceof Saida);
    }
}
