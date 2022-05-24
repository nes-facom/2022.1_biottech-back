<?php

namespace Service;

use App\Model\Entity\Sala;
use App\Model\Entity\TemperaturaUmidade;
use App\Service\SalaService;
use Cake\Http\Exception\BadRequestException;
use Cake\TestSuite\TestCase;

class SalaServiceTest extends TestCase
{
    public function testSaveSala()
    {
        $test = new SalaService();

        $data = [
            "linhagens" => [1, 2],
            "num_sala" => rand(1000, 1000000000)
        ];

        $this->assertTrue($test->saveSalaAndUpdate($data, null) instanceof Sala);

        $this->expectException(BadRequestException::class);
        $test->saveSalaAndUpdate($data, null);
    }

    public function testSaveSalaWithWrongAttribute()
    {
        $test = new SalaService();

        $data = [
            "linhagens" => ["string", 2],
            "num_sala" => rand(1000, 1000000000)
        ];

        $this->expectException(BadRequestException::class);
        $test->saveSalaAndUpdate($data, null);
    }

    public function testSaveSalaWithWrongLinhagem()
    {
        $test = new SalaService();

        $data = [
            "linhagens" => [],
            "num_sala" => rand(1000, 1000000000)
        ];

        $this->expectException(BadRequestException::class);
        $test->saveSalaAndUpdate($data, null);
    }


    public function testEditSala()
    {
        $test = new SalaService();

        $data = [
            "linhagens" => [1, 2],
            "num_sala" => rand(1000, 1000000000)
        ];

        $this->assertTrue($test->saveSalaAndUpdate($data, 1) instanceof Sala);

        $this->assertTrue($test->saveSalaAndUpdate($data, 1) instanceof Sala);
    }

    public function testEditSalaIdNotFound()
    {
        $test = new SalaService();

        $data = [
            "linhagens" => [1, 2],
            "num_sala" => rand(1000, 1000000000)
        ];

        $this->expectException(BadRequestException::class);
        $test->saveSalaAndUpdate($data, 1000000000);
    }

    public function testEditSalaWithWrongNumber()
    {
        $test = new SalaService();

        $data = [
            "linhagens" => [1, 2],
            "num_sala" => 2
        ];

        $this->expectException(BadRequestException::class);
        $test->saveSalaAndUpdate($data, 1);
    }

    public function testSaveTemperaturaUmidade()
    {
        $test = new SalaService();

        $data = [
            "sala_id" => 1,
            "data" => "2022-03-25",
            "temp_matutino" => rand(10, 20),
            "ur_matutino" => "10%",
            "temp_vespertino" => rand(10, 20),
            "ur_vespertino" => "20%",
            "observacoes" => base64_encode(random_bytes(10))
        ];

        $this->assertTrue($test->saveTemperaturaUmidadeAndUpdate($data, null) instanceof TemperaturaUmidade);
    }

    public function testSaveTemperaturaUmidadeWithWrongAttribute()
    {
        $test = new SalaService();

        $data = [
            "sala_id" => 1,
            "data" => "2022-03-25",
            "temp_matutino" => rand(10, 20),
            "ur_matutino" => "10%",
            "temp_vespertino" => "string",
            "ur_vespertino" => "20%",
            "observacoes" => base64_encode(random_bytes(10))
        ];

        $this->expectException(BadRequestException::class);
        $test->saveTemperaturaUmidadeAndUpdate($data, null);
    }

    public function testEditTemperaturaUmidade()
    {
        $test = new SalaService();

        $data = [
            "sala_id" => 1,
            "data" => "2022-03-25",
            "temp_matutino" => rand(10, 20),
            "ur_matutino" => "10%",
            "temp_vespertino" => rand(10, 20),
            "ur_vespertino" => "20%",
            "observacoes" => base64_encode(random_bytes(10))
        ];

        $this->assertTrue($test->saveTemperaturaUmidadeAndUpdate($data, 1) instanceof TemperaturaUmidade);

        $this->assertTrue($test->saveTemperaturaUmidadeAndUpdate($data, 1) instanceof TemperaturaUmidade);
    }

    public function testEditTemperaturaUmidadeIdNotFound()
    {
        $test = new SalaService();

        $data = [
            "sala_id" => 1,
            "data" => "2022-03-25",
            "temp_matutino" => rand(10, 20),
            "ur_matutino" => "10%",
            "temp_vespertino" => rand(10, 20),
            "ur_vespertino" => "20%",
            "observacoes" => base64_encode(random_bytes(10))
        ];

        $this->expectException(BadRequestException::class);
        $test->saveTemperaturaUmidadeAndUpdate($data, 1000000000);
    }

    public function testGetAllSala()
    {
        $test = new SalaService();

        $testGet = $test->getSalas();

        $this->assertTrue($testGet->firstOrFail() instanceof Sala);
    }

    /*public function testGetAllTemperaturaUmidade()
    {
        $test = new SalaService();

        $testGet = $test->getTemperaturaUmidades();

        $this->assertTrue($testGet->firstOrFail() instanceof TemperaturaUmidade);
    }*/

}
