<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pedido Entity
 *
 * @property int $id
 * @property int $ano_id
 * @property int|null $vinculo_institucional_id
 * @property int $projeto_id
 * @property int $especie_id
 * @property int|null $linha_pesquisa_id
 * @property int|null $nivel_projeto_id
 * @property int|null $laboratorio_id
 * @property int $finalidade_id
 * @property int $pesquisador_id
 * @property int $linhagem_id
 * @property int $num_previsao
 * @property string $processo_sei
 * @property string $equipe_executora
 * @property \Cake\I18n\FrozenDate $data_solicitacao
 * @property string $titulo
 * @property string $especificar
 * @property int $exper
 * @property string $num_ceua
 * @property \Cake\I18n\FrozenDate $vigencia_ceua
 * @property int $num_aprovado
 * @property int $num_solicitado
 * @property int $adendo_1
 * @property int $adendo_2
 * @property string $sexo
 * @property string $idade
 * @property string $peso
 * @property string $observacoes
 *
 * @property \App\Model\Entity\Ano $ano
 * @property \App\Model\Entity\VinculoInstitucional $vinculo_institucional
 * @property \App\Model\Entity\Projeto $projeto
 * @property \App\Model\Entity\Especie $especie
 * @property \App\Model\Entity\LinhaPesquisa $linha_pesquisa
 * @property \App\Model\Entity\NivelProjeto $nivel_projeto
 * @property \App\Model\Entity\Laboratorio $laboratorio
 * @property \App\Model\Entity\Finalidade $finalidade
 * @property \App\Model\Entity\Pesquisador $pesquisador
 * @property \App\Model\Entity\Linhagem $linhagem
 * @property \App\Model\Entity\Previsao[] $previsao
 */
class Pedido extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_hidden = ['vinculo_institucional_id', 'projeto_id', 'especie_id', 'linha_pesquisa_id',
        'nivel_projeto_id', 'laboratorio_id', 'finalidade_id', 'pesquisador_id', 'linhagem_id'];
    protected $_accessible = [
        'ano_id' => true,
        'vinculo_institucional_id' => true,
        'projeto_id' => true,
        'especie_id' => true,
        'linha_pesquisa_id' => true,
        'nivel_projeto_id' => true,
        'laboratorio_id' => true,
        'finalidade_id' => true,
        'pesquisador_id' => true,
        'linhagem_id' => true,
        'num_previsao' => true,
        'processo_sei' => true,
        'equipe_executora' => true,
        'data_solicitacao' => true,
        'titulo' => true,
        'especificar' => true,
        'exper' => true,
        'num_ceua' => true,
        'vigencia_ceua' => true,
        'num_aprovado' => true,
        'num_solicitado' => true,
        'adendo_1' => true,
        'adendo_2' => true,
        'sexo' => true,
        'idade' => true,
        'peso' => true,
        'observacoes' => true,
        'ano' => true,
        'vinculo_institucional' => true,
        'projeto' => true,
        'especie' => true,
        'linha_pesquisa' => true,
        'nivel_projeto' => true,
        'laboratorio' => true,
        'finalidade' => true,
        'pesquisador' => true,
        'linhagem' => true,
        'previsao' => true,
    ];
}
