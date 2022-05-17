<?php

namespace Service;

use App\Model\Entity\Parto;
use App\Service\PartoService;
use Cake\Http\Exception\BadRequestException;
use Cake\TestSuite\TestCase;

class PartoServiceTest extends TestCase
{
    public function testSaveParto()
    {
        $test = new PartoService();

        $data = [
            "caixa_matriz_id" => 1,
            "numero_parto" => rand(1000, 1000000000),
            "data_parto" => "2022-03-21",
            "num_macho" => rand(1, 10),
            "num_femea" => rand(1, 10),
            "des_macho" => rand(1, 4),
            "des_femea" => rand(1, 4),
            "qtd_canib" => rand(1, 2),
            "qtd_gamba" => rand(0, 1),
            "qtd_outros" => rand(0, 1)
        ];


        $this->assertTrue($test->savePartoAndUpdate($data, null) instanceof Parto);

        $this->expectException(BadRequestException::class);
        $test->savePartoAndUpdate($data, null);
    }

    public function testSavePartoWithWrongAttribute()
    {
        $test = new PartoService();

        $data = [
            "caixa_matriz_id" => 1,
            "numero_parto" => rand(1000, 1000000000),
            "data_parto" => "2022-03-21",
            "num_macho" => "string",
            "num_femea" => rand(1, 10),
            "des_macho" => rand(1, 4),
            "des_femea" => rand(1, 4),
            "qtd_canib" => rand(1, 2),
            "qtd_gamba" => rand(0, 1),
            "qtd_outros" => rand(0, 1)
        ];

        $this->expectException(BadRequestException::class);
        $test->savePartoAndUpdate($data, null);
    }

    public function testGetNascDesma()
    {
        $test = new PartoService();

        $testGet = $test->getNascDesma();

        $this->assertTrue($testGet->firstOrFail() instanceof Parto);
    }

    public function testEditParto()
    {
        $test = new PartoService();

        $data = [
            "caixa_matriz_id" => 1,
            "numero_parto" => rand(1000, 1000000000),
            "data_parto" => "2022-03-21",
            "num_macho" => rand(1, 10),
            "num_femea" => rand(1, 10),
            "des_macho" => rand(1, 4),
            "des_femea" => rand(1, 4),
            "qtd_canib" => rand(1, 2),
            "qtd_gamba" => rand(0, 1),
            "qtd_outros" => rand(0, 1)
        ];

        $this->assertTrue($test->savePartoAndUpdate($data, 1) instanceof Parto);
    }

    public function testEditPartoIdNotFound()
    {
        $test = new PartoService();

        $data = [
            "caixa_matriz_id" => 1,
            "numero_parto" => rand(20, 30),
            "data_parto" => "2022-03-21",
            "num_macho" => rand(1, 10),
            "num_femea" => rand(1, 10),
            "des_macho" => rand(1, 4),
            "des_femea" => rand(1, 4),
            "qtd_canib" => rand(1, 2),
            "qtd_gamba" => rand(0, 1),
            "qtd_outros" => rand(0, 1)
        ];

        $this->expectException(BadRequestException::class);
        $test->savePartoAndUpdate($data, 1000000000);
    }

}
