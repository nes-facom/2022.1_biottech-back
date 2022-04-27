<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SalaLinhagem Entity
 *
 * @property int $id
 * @property int $linhagem_id
 * @property int $sala_id
 *
 * @property \App\Model\Entity\Linhagem $linhagem
 * @property \App\Model\Entity\Sala $sala
 */
class SalaLinhagem extends Entity
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
        'sala_id' => true,
        'linhagem' => true,
        'sala' => true,
    ];
}
