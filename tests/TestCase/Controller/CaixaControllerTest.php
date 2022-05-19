<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller;

use App\Controller\CaixaController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\CaixaController Test Case
 *
 * @uses \App\Controller\CaixaController
 */
class CaixaControllerTest extends TestCase
{
    use IntegrationTestTrait;



    public function testIndexQueryData(): void
    {
        $this->get('/api/caixa/getEntradaDadosTable.json?page=1&limit=8');

        $this->assertResponseOk();
    }

}
