<?php


namespace App\Test\TestCase\Service;

use App\Model\Entity\Especie;
use App\Model\Entity\Finalidade;
use App\Model\Entity\Laboratorio;
use App\Model\Entity\LinhaPesquisa;
use App\Model\Entity\NivelProjeto;
use App\Model\Entity\Pedido;
use App\Model\Entity\Projeto;
use App\Model\Entity\VinculoInstitucional;
use Cake\Http\Exception\BadRequestException;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
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

        $this->assertTrue($test->saveNivelProjetoAndUpdate($data, null) instanceof NivelProjeto);

        $this->expectException(BadRequestException::class);
        $test->saveNivelProjetoAndUpdate($data, null);
    }

    public function testSaveNivelProjetoUniqueEqualsNull()
    {
        $test = new PedidoService();

        $data = [
            'nome_nivel_projeto' => null,
        ];

        $this->expectException(BadRequestException::class);
        $test->saveNivelProjetoAndUpdate($data, null);
    }

    public function testEditNivelProjeto()
    {
        $test = new PedidoService();

        $data = [
            'nome_nivel_projeto' => base64_encode(random_bytes(10)),
        ];

        $this->assertTrue($test->saveNivelProjetoAndUpdate($data, 1) instanceof NivelProjeto);
    }

    public function testEditNivelProjetoIdNotFound()
    {
        $test = new PedidoService();

        $data = [
            'nome_nivel_projeto' => base64_encode(random_bytes(10)),
        ];

        $this->expectException(BadRequestException::class);
        $test->saveNivelProjetoAndUpdate($data, 1000000000);
    }

    public function testSaveLinhaPesquisa()
    {
        $test = new PedidoService();

        $data = [
            'nome_linha_pesquisa' => base64_encode(random_bytes(10)),
        ];

        $this->assertTrue($test->saveLinhaPesquisaAndUpdate($data, null) instanceof LinhaPesquisa);

        $this->expectException(BadRequestException::class);
        $test->saveLinhaPesquisaAndUpdate($data, null);
    }

    public function testSaveLinhaPesquisaUniqueEqualsNull()
    {
        $test = new PedidoService();

        $data = [
            'nome_linha_pesquisa' => null,
        ];

        $this->expectException(BadRequestException::class);
        $test->saveLinhaPesquisaAndUpdate($data, null);
    }

    public function testEditLinhaPesquisa()
    {
        $test = new PedidoService();

        $data = [
            'nome_linha_pesquisa' => base64_encode(random_bytes(10)),
        ];

        $this->assertTrue($test->saveLinhaPesquisaAndUpdate($data, 1) instanceof LinhaPesquisa);
    }

    public function testEditLinhaPesquisaIdNotFound()
    {
        $test = new PedidoService();

        $data = [
            'nome_linha_pesquisa' => base64_encode(random_bytes(10)),
        ];

        $this->expectException(BadRequestException::class);
        $test->saveLinhaPesquisaAndUpdate($data, 1000000000);
    }

    public function testSaveFinalidade()
    {
        $test = new PedidoService();

        $data = [
            'nome_finalidade' => base64_encode(random_bytes(10)),
        ];

        $this->assertTrue($test->saveFinalidadeAndUpdate($data, null) instanceof Finalidade);

        $this->expectException(BadRequestException::class);
        $test->saveFinalidadeAndUpdate($data, null);
    }

    public function testSaveFinalidadeUniqueEqualsNull()
    {
        $test = new PedidoService();

        $data = [
            'nome_finalidade' => null,
        ];

        $this->expectException(BadRequestException::class);
        $test->saveFinalidadeAndUpdate($data, null);
    }

    public function testEditFinalidade()
    {
        $test = new PedidoService();

        $data = [
            'nome_finalidade' => base64_encode(random_bytes(10)),
        ];

        $this->assertTrue($test->saveFinalidadeAndUpdate($data, 1) instanceof Finalidade);
    }

    public function testEditFinalidadeIdNotFound()
    {
        $test = new PedidoService();

        $data = [
            'nome_finalidade' => base64_encode(random_bytes(10)),
        ];

        $this->expectException(BadRequestException::class);
        $test->saveFinalidadeAndUpdate($data, 1000000000);
    }

    public function testSaveLaboratorio()
    {
        $test = new PedidoService();

        $data = [
            'nome_laboratorio' => base64_encode(random_bytes(10)),
        ];

        $this->assertTrue($test->saveLaboratorioAndUpdate($data, null) instanceof Laboratorio);

        $this->expectException(BadRequestException::class);
        $test->saveLaboratorioAndUpdate($data, null);
    }

    public function testSaveLaboratorioUniqueEqualsNull()
    {
        $test = new PedidoService();

        $data = [
            'nome_laboratorio' => null,
        ];

        $this->expectException(BadRequestException::class);
        $test->saveLaboratorioAndUpdate($data, null);
    }

    public function testEditLaboratorio()
    {
        $test = new PedidoService();

        $data = [
            'nome_laboratorio' => base64_encode(random_bytes(10)),
        ];


        $this->assertTrue($test->saveLaboratorioAndUpdate($data, 1) instanceof Laboratorio);
    }

    public function testEditLaboratorioIdNotFound()
    {
        $test = new PedidoService();

        $data = [
            'nome_laboratorio' => base64_encode(random_bytes(10)),
        ];

        $this->expectException(BadRequestException::class);
        $test->saveLaboratorioAndUpdate($data, 1000000000);
    }

    public function testSaveVinculoInstitucional()
    {
        $test = new PedidoService();

        $data = [
            'nome_vinculo_institucional' => base64_encode(random_bytes(10)),
        ];

        $this->assertTrue($test->saveVinculoInstitucionalAndUpdate($data, null) instanceof VinculoInstitucional);

        $this->expectException(BadRequestException::class);
        $test->saveVinculoInstitucionalAndUpdate($data, null);
    }

    public function testSaveVinculoInstitucionalUniqueEqualsNull()
    {
        $test = new PedidoService();

        $data = [
            'nome_vinculo_institucional' => null,
        ];

        $this->expectException(BadRequestException::class);
        $test->saveVinculoInstitucionalAndUpdate($data, null);
    }

    public function testEditVinculoInstitucional()
    {
        $test = new PedidoService();

        $data = [
            'nome_vinculo_institucional' => base64_encode(random_bytes(10)),
        ];

        $this->assertTrue($test->saveVinculoInstitucionalAndUpdate($data, 1) instanceof VinculoInstitucional);
    }

    public function testEditVinculoInstitucionalIdNotFound()
    {
        $test = new PedidoService();

        $data = [
            'nome_vinculo_institucional' => base64_encode(random_bytes(10)),
        ];

        $this->expectException(BadRequestException::class);
        $test->saveVinculoInstitucionalAndUpdate($data, 1000000000);
    }

    public function testSaveProjeto()
    {
        $test = new PedidoService();

        $data = [
            'nome_projeto' => base64_encode(random_bytes(10)),
        ];

        $this->assertTrue($test->saveProjetoAndUpdate($data, null) instanceof Projeto);

        $this->expectException(BadRequestException::class);
        $test->saveProjetoAndUpdate($data, null);
    }

    public function testSaveProjetoUniqueEqualsNull()
    {
        $test = new PedidoService();

        $data = [
            'nome_projeto' => null,
        ];

        $this->expectException(BadRequestException::class);
        $test->saveProjetoAndUpdate($data, null);
    }

    public function testEditProjeto()
    {
        $test = new PedidoService();

        $data = [
            'nome_projeto' => base64_encode(random_bytes(10)),
        ];

        $this->assertTrue($test->saveProjetoAndUpdate($data, 1) instanceof Projeto);
    }

    public function testEditProjetoIdNotFound()
    {
        $test = new PedidoService();

        $data = [
            'nome_projeto' => base64_encode(random_bytes(10)),
        ];

        $this->expectException(BadRequestException::class);
        $test->saveProjetoAndUpdate($data, 1000000000);
    }

    public function testSaveEspecie()
    {
        $test = new PedidoService();

        $data = [
            'nome_especie' => base64_encode(random_bytes(10)),
        ];

        $this->assertTrue($test->saveEspecieAndUpdate($data, null) instanceof Especie);

        $this->expectException(BadRequestException::class);
        $test->saveEspecieAndUpdate($data, null);
    }

    public function testSaveEspecieUniqueEqualsNull()
    {
        $test = new PedidoService();

        $data = [
            'nome_especie' => null,
        ];

        $this->expectException(BadRequestException::class);
        $test->saveEspecieAndUpdate($data, null);
    }

    public function testEditEspecie()
    {
        $test = new PedidoService();

        $data = [
            'nome_especie' => base64_encode(random_bytes(10)),
        ];

        $this->assertTrue($test->saveEspecieAndUpdate($data, 1) instanceof Especie);
    }

    public function testEditEspecieIdNotFound()
    {
        $test = new PedidoService();

        $data = [
            'nome_especie' => base64_encode(random_bytes(10)),
        ];

        $this->expectException(BadRequestException::class);
        $test->saveEspecieAndUpdate($data, 1000000000);
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
            "num_aprovado" => rand(1, 30),
            "num_solicitado" => rand(1, 30),
            "adendo_1" => rand(1, 30),
            "adendo_2" => rand(1, 30),
            "sexo" => "macho",
            "idade" => rand(1, 30),
            "peso" => rand(1, 30),
            "observacoes" => base64_encode(random_bytes(30))
        ];

        $this->assertTrue($test->savePedidoAndUpdate($data, null) instanceof Pedido);

        $this->expectException(BadRequestException::class);
        $data["vinculo_institucional_id"] = "string";
        $test->savePedidoAndUpdate($data, null);
    }

    public function testEditPedido()
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
            "num_aprovado" => rand(1, 30),
            "num_solicitado" => rand(1, 30),
            "adendo_1" => rand(1, 30),
            "adendo_2" => rand(1, 30),
            "sexo" => "macho",
            "idade" => rand(1, 30),
            "peso" => rand(1, 30),
            "observacoes" => base64_encode(random_bytes(30))
        ];

        $this->assertTrue($test->savePedidoAndUpdate($data, 1) instanceof Pedido);
    }

    public function testEditPedidoIdNotFound()
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
            "num_aprovado" => rand(1, 30),
            "num_solicitado" => rand(1, 30),
            "adendo_1" => rand(1, 30),
            "adendo_2" => rand(1, 30),
            "sexo" => "macho",
            "idade" => rand(1, 30),
            "peso" => rand(1, 30),
            "observacoes" => base64_encode(random_bytes(30))
        ];

        $this->expectException(BadRequestException::class);
        $test->savePedidoAndUpdate($data, 1000000000);
    }


    public function testGetAllPedidos()
    {
        $test = new PedidoService();

       $this->assertNotNull($test->getPedidosTable(null, '2022'));
    }
}
