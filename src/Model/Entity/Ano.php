<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ano Entity
 *
 * @property int $id
 * @property int $ano
 *
 * @property \App\Model\Entity\Caixa[] $caixa
 * @property \App\Model\Entity\Parto[] $parto
 * @property \App\Model\Entity\Pedido[] $pedido
 * @property \App\Model\Entity\Saida[] $saida
 * @property \App\Model\Entity\TemperaturaUmidade[] $temperatura_umidade
 */
class Ano extends Entity
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
        'ano' => true,
        'caixa' => true,
        'parto' => true,
        'pedido' => true,
        'saida' => true,
        'temperatura_umidade' => true,
    ];
}
