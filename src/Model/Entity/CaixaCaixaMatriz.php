<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CaixaCaixaMatriz Entity
 *
 * @property int $id
 * @property int $caixa_matriz_id
 * @property int $caixa_id
 * @property string $peso
 *
 * @property \App\Model\Entity\CaixaMatriz $caixa_matriz
 * @property \App\Model\Entity\Caixa $caixa
 */
class CaixaCaixaMatriz extends Entity
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
        'caixa_matriz_id' => true,
        'caixa_id' => true,
        'peso' => true,
        'caixa_matriz' => true,
        'caixa' => true,
    ];
}
