<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TemperaturaUmidade Entity
 *
 * @property int $id
 * @property int|null $sala_id
 * @property \Cake\I18n\FrozenDate $data
 * @property string|null $temp_matutino
 * @property string|null $ur_matutino
 * @property string|null $temp_vespertino
 * @property string|null $ur_vespertino
 * @property string|null $observacoes
 *
 * @property \App\Model\Entity\Sala $sala
 */
class TemperaturaUmidade extends Entity
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
        'sala_id' => true,
        'data' => true,
        'temp_matutino' => true,
        'ur_matutino' => true,
        'temp_vespertino' => true,
        'ur_vespertino' => true,
        'observacoes' => true,
        'sala' => true,
    ];
}
