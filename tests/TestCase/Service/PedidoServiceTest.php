<?php


namespace App\Test\TestCase\Service;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use App\Service\PedidoService;


/**
 * Description of PedidoServiceTest
 *
 * @author Leonardo
 */
class PedidoServiceTest extends TestCase
{

    public function testSaveNivelProjeto()
    {
        $test = new PedidoService();

        $data = [
            'nome_nivel_projeto' => base64_encode(random_bytes(10)),
        ];
        $testSave = $test->saveNivelProjeto($data);

        $this->assertNotFalse($testSave);
    }

    public function testSaveLinhaPesquisa()
    {
        $test = new PedidoService();

        $data = [
            'nome_linha_pesquisa' => base64_encode(random_bytes(10)),
        ];
        $testSave = $test->saveLinhaPesquisa($data);

        $this->assertNotFalse($testSave);
    }

    public function testSaveFinalidade()
    {
        $test = new PedidoService();

        $data = [
            'nome_finalidade' => base64_encode(random_bytes(10)),
        ];
        $testSave = $test->saveFinalidade($data);

        $this->assertNotFalse($testSave);
    }

    public function testSaveLaboratorio()
    {
        $test = new PedidoService();

        $data = [
            'nome_laboratorio' => base64_encode(random_bytes(10)),
        ];
        $testSave = $test->saveLaboratorio($data);

        $this->assertNotFalse($testSave);
    }

    public function testSaveVinculoInstitucional()
    {
        $test = new PedidoService();

        $data = [
            'nome_vinculo_institucional' => base64_encode(random_bytes(10)),
        ];
        $testSave = $test->saveVinculoInstitucional($data);

        $this->assertNotFalse($testSave);
    }

    public function testSaveProjeto()
    {
        $test = new PedidoService();

        $data = [
            'nome_projeto' => base64_encode(random_bytes(10)),
        ];
        $testSave = $test->saveProjeto($data);

        $this->assertNotFalse($testSave);
    }

    public function testSaveEspecie()
    {
        $test = new PedidoService();

        $data = [
            'nome_especie' => base64_encode(random_bytes(10)),
        ];
        $testSave = $test->saveEspecie($data);

        $this->assertNotFalse($testSave);
    }

    public function testSavePedido()
    {
        $test = new PedidoService();

        $data = [
            "vinculo_institucional_id" => 1,
            "projeto_id" => 1,
            "especie_id" => 1,
            "linha_pesquisa_id" => 1,
            "nivel_projeto_id" => 1,
            "laboratorio_id" => 1,
            "finalidade_id" => 1,
            "pesquisador_id" => 1,
            "linhagem_id" => 1,
            "processo_sei" => base64_encode(random_bytes(10)),
            "equipe_executora" => "Fabrício",
            "data_solicitacao" => "2022-04-28",
            "titulo" => base64_encode(random_bytes(10)),
            "especificar" => base64_encode(random_bytes(10)),
            "exper" => "não",
            "num_ceua" => base64_encode(random_bytes(10)),
            "vigencia_ceua" => "2022-03-25",
            "num_aprovado" => rand(1,30),
            "num_solicitado" => rand(1,30),
            "adendo_1" => rand(1,30),
            "adendo_2" => rand(1,30),
            "sexo" => "macho",
            "idade" => rand(1,30),
            "peso" => rand(1,30),
            "observacoes" =>  base64_encode(random_bytes(30))

        ];
        $testSave = $test->savePedido($data);

        $this->assertNotFalse($testSave);
    }

}
