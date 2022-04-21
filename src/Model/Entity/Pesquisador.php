<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pesquisador Entity
 *
 * @property int $id
 * @property string $nome
 * @property string $instituicao
 * @property string $setor
 * @property string|null $pos
 * @property string|null $ramal
 * @property string $email
 * @property bool $orientador
 *
 * @property \App\Model\Entity\Pedido[] $pedido
 * @property \App\Model\Entity\Telefone[] $telefones
 */
class Pesquisador extends Entity
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
        'nome' => true,
        'instituicao' => true,
        'setor' => true,
        'pos' => true,
        'ramal' => true,
        'email' => true,
        'orientador' => true,
        'pedido' => true,
        'telefones' => true,
    ];
}
