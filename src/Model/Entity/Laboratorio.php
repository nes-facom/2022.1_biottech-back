<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Laboratorio Entity
 *
 * @property int $id
 * @property string $nome_laboratorio
 * @property bool $active
 *
 * @property \App\Model\Entity\Pedido[] $pedido
 */
class Laboratorio extends Entity
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
        'nome_laboratorio' => true,
        'active' => true,
        'pedido' => true,
    ];
}
