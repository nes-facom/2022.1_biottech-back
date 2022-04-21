<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Telefone Entity
 *
 * @property int $id
 * @property int|null $pesquisador_id
 * @property string $telefone
 *
 * @property \App\Model\Entity\Pesquisador $pesquisador
 */
class Telefone extends Entity
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
        'pesquisador_id' => true,
        'telefone' => true,
        'pesquisador' => true,
    ];
}
