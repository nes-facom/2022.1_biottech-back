<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EspecieLinhagem Entity
 *
 * @property int $id
 * @property int $especie_id
 * @property int $linhagem_id
 *
 * @property \App\Model\Entity\SubLinhaPesquisa $sub_linha_pesquisa
 * @property \App\Model\Entity\LinhaPesquisa $linha_pesquisa
 */
class EspecieLinhagem extends Entity
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
        'especie_id' => true,
        'linhagem_id' => true,
        'sub_linha_pesquisa' => true,
        'linha_pesquisa' => true,
    ];
}
