<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SubLinhaPesquisaLinhaPesquisa Entity
 *
 * @property int $id
 * @property int $sub_linha_pesquisa_id
 * @property int $linha_pesquisa_id
 *
 * @property \App\Model\Entity\SubLinhaPesquisa $sub_linha_pesquisa
 * @property \App\Model\Entity\LinhaPesquisa $linha_pesquisa
 */
class SubLinhaPesquisaLinhaPesquisa extends Entity
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
        'sub_linha_pesquisa_id' => true,
        'linha_pesquisa_id' => true,
        'sub_linha_pesquisa' => true,
        'linha_pesquisa' => true,
    ];
}
