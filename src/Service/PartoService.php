<?php


namespace App\Service;

use Cake\ORM\TableRegistry;

/**
 * Description of PartoService
 *
 * @author Leonardo
 */
class PartoService
{

    public function saveParto($data)
    {
        $table = TableRegistry::getTableLocator()->get('Parto');
        $newEmptyTable = $table->newEmptyEntity();

        $mapTable = $table->patchEntity($newEmptyTable, $data);

        $table->saveOrFail($mapTable);

    }

}
