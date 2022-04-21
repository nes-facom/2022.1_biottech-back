<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Parto Entity
 *
 * @property int $id
 * @property int $numero_parto
 * @property \Cake\I18n\FrozenDate $data_parto
 * @property int $num_macho
 * @property int $num_femea
 * @property int $des_macho
 * @property int $des_femea
 * @property int $qtd_canib
 * @property int $qtd_gamba
 * @property int|null $qtd_outros
 *
 * @property \App\Model\Entity\PartoMatriz[] $parto_matriz
 */
class Parto extends Entity
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
        'numero_parto' => true,
        'data_parto' => true,
        'num_macho' => true,
        'num_femea' => true,
        'des_macho' => true,
        'des_femea' => true,
        'qtd_canib' => true,
        'qtd_gamba' => true,
        'qtd_outros' => true,
        'parto_matriz' => true,
    ];
}
