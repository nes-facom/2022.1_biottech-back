<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sala Entity
 *
 * @property int $id
 * @property int $num_sala
 * @property bool $active
 *
 * @property \App\Model\Entity\TemperaturaUmidade[] $temperatura_umidade
 * @property \App\Model\Entity\Linhagem[] $linhagem
 */
class Sala extends Entity
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
        'num_sala' => true,
        'active' => true,
        'temperatura_umidade' => true,
        'linhagem' => true,
    ];
}
