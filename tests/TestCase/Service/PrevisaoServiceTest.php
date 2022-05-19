<?php

namespace App\Test\TestCase\Service;

use App\Model\Entity\Previsao;
use App\Service\PrevisaoService;
use Cake\Http\Exception\BadRequestException;
use Cake\TestSuite\TestCase;

class PrevisaoServiceTest extends TestCase
{

    public function testSavePrevisao()
    {
        $test = new PrevisaoService();

        $data = [
            "pedido_id" => 1,
            "num_previsao" => rand(1000, 1000000000),
            "retirada_num" => rand(1, 10),
            "qtd_retirar" => rand(1, 10),
            "retirada_data" => "2022-03-25",
            "status" => "status"
        ];

        $this->assertTrue($test->savePrevisaoAndUpdate($data, null) instanceof Previsao);

        $this->expectException(BadRequestException::class);
        $test->savePrevisaoAndUpdate($data, null);
    }

    public function testSavePrevisaoWithWrongAttribute()
    {
        $test = new PrevisaoService();

        $data = [
            "pedido_id" => 1,
            "num_previsao" => rand(20, 30),
            "retirada_num" => rand(1, 10),
            "qtd_retirar" => "string",
            "retirada_data" => "2022-03-25",
            "status" => "status"
        ];

        $this->expectException(BadRequestException::class);
        $test->savePrevisaoAndUpdate($data, null);
    }

    public function testEditPrevisao()
    {
        $test = new PrevisaoService();

        $data = [
            "pedido_id" => 1,
            "num_previsao" => 10,
            "retirada_num" => rand(1, 10),
            "qtd_retirar" => rand(1, 10),
            "retirada_data" => "2022-03-25",
            "status" => "status"
        ];

        $this->assertTrue($test->savePrevisaoAndUpdate($data, 1) instanceof Previsao);

        $this->assertTrue($test->savePrevisaoAndUpdate($data, 1) instanceof Previsao);
    }

    public function testEditPrevisaoWithWrongNumber()
    {
        $test = new PrevisaoService();

        $data = [
            "pedido_id" => 1,
            "num_previsao" => 2,
            "retirada_num" => rand(1, 10),
            "qtd_retirar" => rand(1, 10),
            "retirada_data" => "2022-03-25",
            "status" => "status"
        ];

        $this->expectException(BadRequestException::class);
        $test->savePrevisaoAndUpdate($data, 1);
    }

    public function testEditPrevisaoIdNotFound()
    {
        $test = new PrevisaoService();

        $data = [
            "pedido_id" => 1,
            "num_previsao" => rand(1000, 1000000000),
            "retirada_num" => rand(1, 10),
            "qtd_retirar" => rand(1, 10),
            "retirada_data" => "2022-03-25",
            "status" => "status"
        ];

        $this->expectException(BadRequestException::class);
        $test->savePrevisaoAndUpdate($data, 1000000000);
    }

    public function testGetAllPesquisadores()
    {
        $test = new PrevisaoService();

        $testGet = $test->getPrevisao();

        $this->assertTrue($testGet->firstOrFail() instanceof Previsao);
    }
}
