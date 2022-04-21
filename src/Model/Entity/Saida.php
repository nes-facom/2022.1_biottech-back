<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Saida Entity
 *
 * @property int $id
 * @property int|null $caixa_id
 * @property \Cake\I18n\FrozenDate $data_saida
 * @property string $tipo_ocorrencia
 * @property string|null $usuario
 * @property int $num_animais
 * @property string $saida
 * @property string $sexo
 * @property int $sobra
 * @property string|null $observacoes
 *
 * @property \App\Model\Entity\Caixa $caixa
 */
class Saida extends Entity
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
        'caixa_id' => true,
        'data_saida' => true,
        'tipo_ocorrencia' => true,
        'usuario' => true,
        'num_animais' => true,
        'saida' => true,
        'sexo' => true,
        'sobra' => true,
        'observacoes' => true,
        'caixa' => true,
    ];
}
