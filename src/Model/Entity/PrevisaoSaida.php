<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PrevisaoSaida Entity
 *
 * @property int $id
 * @property int $previsao_id
 * @property int $saida_id
 *
 * @property \App\Model\Entity\Previsao $previsao
 * @property \App\Model\Entity\Saida $saida
 */
class PrevisaoSaida extends Entity
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
        'previsao_id' => true,
        'saida_id' => true,
        'previsao' => true,
        'saida' => true,
    ];
}
