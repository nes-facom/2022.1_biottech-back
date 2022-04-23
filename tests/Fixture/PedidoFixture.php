<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PedidoFixture
 */
class PedidoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'pedido';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'ano_id' => 1,
                'vinculo_institucional_id' => 1,
                'projeto_id' => 1,
                'especie_id' => 1,
                'linha_pesquisa_id' => 1,
                'nivel_projeto_id' => 1,
                'laboratorio_id' => 1,
                'finalidade_id' => 1,
                'pesquisador_id' => 1,
                'linhagem_id' => 1,
                'num_previsao' => 1,
                'processo_sei' => 'Lorem ipsum dolor sit amet',
                'equipe_executora' => 'Lorem ipsum dolor sit amet',
                'data_solicitacao' => '2022-04-22',
                'titulo' => 'Lorem ipsum dolor sit amet',
                'especificar' => 'Lorem ipsum dolor sit amet',
                'exper' => 1,
                'num_ceua' => 'Lorem ipsum dolor sit amet',
                'vigencia_ceua' => '2022-04-22',
                'num_aprovado' => 1,
                'num_solicitado' => 1,
                'adendo_1' => 1,
                'adendo_2' => 1,
                'sexo' => 'Lorem ipsum dolor sit amet',
                'idade' => 'Lorem ipsum dolor sit amet',
                'peso' => 1.5,
                'observacoes' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
