<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Previsao Entity
 *
 * @property int $id
 * @property int|null $pedido_id
 * @property int $num_previsao
 * @property string $retirada_num
 * @property int $qtd_retirar
 * @property \Cake\I18n\FrozenDate $retirada_data
 * @property string $status
 * @property int $totalRetirado
 * @property bool $active
 *
 * @property \App\Model\Entity\Pedido $pedido
 * @property \App\Model\Entity\Saida[] $saida
 */
class Previsao extends Entity
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
        'pedido_id' => true,
        'num_previsao' => true,
        'retirada_num' => true,
        'qtd_retirar' => true,
        'retirada_data' => true,
        'status' => true,
        'totalRetirado' => true,
        'active' => true,
        'pedido' => true,
        'saida' => true,
    ];
}
