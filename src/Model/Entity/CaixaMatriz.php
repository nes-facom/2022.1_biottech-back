<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CaixaMatriz Entity
 *
 * @property int $id
 * @property string $caixa_matriz_numero
 * @property \Cake\I18n\FrozenDate $data_acasalamento
 * @property \Cake\I18n\FrozenDate|null $saida_da_colonia
 * @property \Cake\I18n\FrozenDate|null $data_obito
 *
 * @property \App\Model\Entity\Caixa[] $caixa
 * @property \App\Model\Entity\Parto[] $parto
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
        'caixa_matriz_numero' => true,
        'data_acasalamento' => true,
        'saida_da_colonia' => true,
        'data_obito' => true,
        'caixa' => true,
        'parto' => true,
    ];
}
