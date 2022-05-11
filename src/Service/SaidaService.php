<?php

namespace App\Service;

use Cake\Datasource\ConnectionManager;
use Cake\Http\Exception\BadRequestException;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Exception;
use phpDocumentor\Reflection\Types\Void_;

class SaidaService
{

    /**
     * By default all the associations on this table will be hydrated. You can
     * limit which associations are built, or include deeper associations
     * using the options parameter:
     *
     * ```
     * $article = $this->Articles->newEntity(
     *   $this->request->getData(),
     *   ['associated' => ['Tags', 'Comments.Users']]
     * );
     * ```
     *
     * You can limit fields that will be present in the constructed entity by
     * passing the `fields` option, which is also accepted for associations:
     *
     * ```
     * $article = $this->Articles->newEntity($this->request->getData(), [
     *  'fields' => ['title', 'body', 'tags', 'comments'],
     *  'associated' => ['Tags', 'Comments.Users' => ['fields' => 'username']]
     * ]
     * );
     * ```
     *
     * The `fields` option lets remove or restrict input data from ending up in
     * the entity. If you'd like to relax the entity's default accessible fields,
     * you can use the `accessibleFields` option:
     *
     * ```
     * $article = $this->Articles->newEntity(
     *   $this->request->getData(),
     *   ['accessibleFields' => ['protected_field' => true]]
     * );
     * ```
     *
     * By default, the data is validated before being passed to the new entity. In
     * the case of invalid fields, those will not be present in the resulting object.
     * The `validate` option can be used to disable validation on the passed data:
     *
     * ```
     * $article = $this->Articles->newEntity(
     *   $this->request->getData(),
     *   ['validate' => false]
     * );
     * ```
     *
     * You can also pass the name of the validator to use in the `validate` option.
     * If `null` is passed to the first param of this function, no validation will
     * be performed.
     *
     * You can use the `Model.beforeMarshal` event to modify request data
     * before it is converted into entities.
     *
     * @param array $data The data to build an entity with.
     * @return Void_
     * @throws \Exception
     */
    public function saveSaida($data)
    {
        $tableSaida = TableRegistry::getTableLocator()->get('Saida');
        $newEmptyTableSaida = $tableSaida->newEmptyEntity();

        $tablePrevisaoSaida = TableRegistry::getTableLocator()->get('PrevisaoSaida');
        $newEmptyTablePrevisaoSaida = $tablePrevisaoSaida->newEmptyEntity();

        $tablePrevisao = TableRegistry::getTableLocator()->get('Previsao');

        try {

            $newEmptyTableSaida->caixa_id = $data['caixa_id'];
            $newEmptyTableSaida->data_saida = $data['data_saida'];
            $newEmptyTableSaida->tipo_saida = $data['tipo_saida'];
            $newEmptyTableSaida->usuario = $data['usuario'];
            $newEmptyTableSaida->num_animais = $data['num_animais'];
            $newEmptyTableSaida->saida = $data['saida'];
            $newEmptyTableSaida->sexo = $data['sexo'];
            $newEmptyTableSaida->sobra = $data['sobra'];
            $newEmptyTableSaida->observacoes = $data['observacoes'];


            $connection = ConnectionManager::get('default');

            $connection->transactional(function () use ($tableSaida, $newEmptyTableSaida, $newEmptyTablePrevisaoSaida, $data, $tablePrevisaoSaida, $tablePrevisao) {
                $saveSaida = $tableSaida->saveOrFail($newEmptyTableSaida, ['atomic' => true]);

                if ($data['tipo_saida'] == 'fornecimento') {

                    $newEmptyTablePrevisao = $tablePrevisao->find()->where(['id' => $data['previsao_id']])->first();
                    $newEmptyTablePrevisao->totalRetirado = $newEmptyTablePrevisao->totalRetirado + $saveSaida->num_animais;
                    $tablePrevisao->saveOrFail($newEmptyTablePrevisao);

                    $newEmptyTablePrevisaoSaida->previsao_id = $data['previsao_id'];

                    $newEmptyTablePrevisaoSaida->saida_id = $saveSaida->id;

                    $tablePrevisaoSaida->saveOrFail($newEmptyTablePrevisaoSaida, ['atomic' => true]);
                }

            });

        } catch (Exception $e) {
            throw new BadRequestException('Ocorreu algum problema no cadastro, por favor entre em contato com o suporte técnico ou tente novamente mais tarde.');
        }

    }

    public function getSaida(): Query
    {
        $table = TableRegistry::getTableLocator()->get('Saida');

        return $table->find('all')->contain([
            'Caixa' => [
                'fields' => [
                    'caixa_numero'
                ]
            ]
        ]);

    }

}
