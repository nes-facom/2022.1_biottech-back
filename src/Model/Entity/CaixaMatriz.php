<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CaixaMatriz Entity
 *
 * @property int $id
 * @property int|null $caixa_macho_id
 * @property int|null $caixa_femea_id
 * @property string $caixa_matriz_numero
 * @property string $tipo_acasalamento
 * @property int $num_femea
 * @property \Cake\I18n\FrozenDate $data_acasalamento
 * @property int $intervalo_parto
 * @property string $peso_macho
 * @property string $peso_femea
 * @property \Cake\I18n\FrozenDate $saida_da_colonia
 *
 * @property \App\Model\Entity\Caixa[] $caixa
 * @property \App\Model\Entity\PartoMatriz[] $parto_matriz
 */
class CaixaMatriz extends Entity
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
        'caixa_macho_id' => true,
        'caixa_femea_id' => true,
        'caixa_matriz_numero' => true,
        'tipo_acasalamento' => true,
        'num_femea' => true,
        'data_acasalamento' => true,
        'intervalo_parto' => true,
        'peso_macho' => true,
        'peso_femea' => true,
        'saida_da_colonia' => true,
        'caixa' => true,
        'parto_matriz' => true,
    ];
}
