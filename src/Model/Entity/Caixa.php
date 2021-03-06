<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Caixa Entity
 *
 * @property int $id
 * @property int|null $linhagem_id
 * @property int|null $caixa_matriz_id
 * @property string $caixa_numero
 * @property \Cake\I18n\FrozenDate $nascimento
 * @property string $sexo
 * @property int $num_animais
 * @property int|null $qtd_saida
 * @property \Cake\I18n\FrozenDate|null $ultima_saida
 * @property bool $active
 *
 * @property \App\Model\Entity\Linhagem $linhagem
 * @property \App\Model\Entity\CaixaMatriz[] $caixa_matriz
 * @property \App\Model\Entity\Saida[] $saida
 */
class Caixa extends Entity
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
    protected $_accessible = [
        'linhagem_id' => true,
        'caixa_matriz_id' => true,
        'caixa_numero' => true,
        'nascimento' => true,
        'sexo' => true,
        'num_animais' => true,
        'qtd_saida' => true,
        'ultima_saida' => true,
        'active' => true,
        'linhagem' => true,
        'caixa_matriz' => true,
        'saida' => true,
    ];
}
