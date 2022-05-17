<?php

namespace Service;

use App\Model\Entity\Caixa;
use App\Service\CaixaService;
use Cake\Http\Exception\BadRequestException;
use Cake\TestSuite\TestCase;

class CaixaServiceTest extends TestCase
{
    public function testSaveCaixa()
    {
        $test = new CaixaService();

        $data = [
            "linhagem_id" => 2,
            "caixa_numero" => base64_encode(random_bytes(10)),
            "nascimento" => "2022-03-25",
            "sexo" => "femea",
            "num_animais" => rand(20, 30)
        ];

        $this->assertTrue($test->saveCaixaAndUpdate($data, null) instanceof Caixa);

        $this->expectException(BadRequestException::class);
        $test->saveCaixaAndUpdate($data, null);
    }

    public function testSaveCaixaWithWrongAttribute()
    {
        $test = new CaixaService();

        $data = [
            "linhagem_id" => "string",
            "caixa_numero" => base64_encode(random_bytes(10)),
            "nascimento" => "2022-03-25",
            "sexo" => "femea",
            "num_animais" => rand(20, 30)
        ];

        $this->expectException(BadRequestException::class);
        $test->saveCaixaAndUpdate($data, null);
    }

    public function testEditCaixa()
    {
        $test = new CaixaService();

        $data = [
            "linhagem_id" => 2,
            "caixa_numero" => base64_encode(random_bytes(10)),
            "nascimento" => "2022-03-25",
            "sexo" => "femea",
            "num_animais" => rand(20, 30)
        ];

        $this->assertTrue($test->saveCaixaAndUpdate($data, 1) instanceof Caixa);

        $this->assertTrue($test->saveCaixaAndUpdate($data, 1) instanceof Caixa);
    }

    public function testEditCaixaWithWrongCaixaNumber()
    {
        $test = new CaixaService();

        $data = [
            "linhagem_id" => 2,
            "caixa_numero" => "2",
            "nascimento" => "2022-03-25",
            "sexo" => "femea",
            "num_animais" => rand(20, 30)
        ];

        $this->expectException(BadRequestException::class);
        $this->assertTrue($test->saveCaixaAndUpdate($data, 1) instanceof Caixa);

    }

    public function testEditCaixaIdNotFound()
    {
        $test = new CaixaService();

        $data = [
            "linhagem_id" => 2,
            "caixa_numero" => base64_encode(random_bytes(10)),
            "nascimento" => "2022-03-25",
            "sexo" => "femea",
            "num_animais" => rand(20, 30)
        ];

        $this->expectException(BadRequestException::class);
        $test->saveCaixaAndUpdate($data, 1000000000);
    }

    public function testGetAllPesquisadores()
    {
        $test = new CaixaService();

        $testGet = $test->getEntradaDados();

        $this->assertTrue($testGet->firstOrFail() instanceof Caixa);
    }
}
