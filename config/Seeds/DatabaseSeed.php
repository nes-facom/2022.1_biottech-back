<?php
declare(strict_types=1);

use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use Migrations\AbstractSeed;

/**
 * Database seed.
 */
class DatabaseSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        //add admin User
        $hasher = new DefaultPasswordHasher();
        $users = [
            [
                'name' => 'Admin',
                'username' => 'admin@admin.com',
                'password' => $hasher->hash('123'),
                'type' => 0
            ]
        ];

        $table = $this->table('users');
        $table->insert($users)->save();

        //add Nivel Projeto
        $nivelProjeto = [
            [
                'nome_nivel_projeto' => 'Doutorado'
            ],
            [
                'nome_nivel_projeto' => 'Especialização'
            ],
            [
                'nome_nivel_projeto' => 'Graduação'
            ],
            [
                'nome_nivel_projeto' => 'Iniciação Científica'
            ],
            [
                'nome_nivel_projeto' => 'Mestrado'
            ],
            [
                'nome_nivel_projeto' => 'Residência Médica'
            ],
            [
                'nome_nivel_projeto' => 'TCC'
            ],
            [
                'nome_nivel_projeto' => 'Projeto de Pesquisa'
            ]
        ];

        $table = TableRegistry::getTableLocator()->get('NivelProjeto');
        $newEmptyTable = $table->newEmptyEntity();
        foreach ($nivelProjeto as $item) {
            $table->saveOrFail($table->patchEntity($newEmptyTable, $item), ['atomic' => true]);
        }



        //add Sub Linha De Pesquisa
        $subLinhaPesquisa = [
            [
                'nome_sub_linha_pesquisa' => 'Saúde e Desenvolvimento na Região Centro-Oeste'
            ],
            [
                'nome_sub_linha_pesquisa' => 'Química'
            ],
            [
                'nome_sub_linha_pesquisa' => 'Psicologia'
            ],
            [
                'nome_sub_linha_pesquisa' => 'Doenças Infecciosas e Parasitárias'
            ],
            [
                'nome_sub_linha_pesquisa' => 'Ciências Veterinárias'
            ],
            [
                'nome_sub_linha_pesquisa' => 'Ciências Farmacêuticas'
            ],
            [
                'nome_sub_linha_pesquisa' => 'Ciências do Movimento'
            ],
            [
                'nome_sub_linha_pesquisa' => 'Ciência Animal'
            ],
            [
                'nome_sub_linha_pesquisa' => 'Biotecnologia'
            ],
            [
                'nome_sub_linha_pesquisa' => 'Bioquímica e Biologia Molecular'
            ],
            [
                'nome_sub_linha_pesquisa' => 'Biologia Animal'
            ],
            [
                'nome_sub_linha_pesquisa' => 'Biotecnologia e Biodiversidade'
            ],
            [
                'nome_sub_linha_pesquisa' => 'Ciência dos Materiais'
            ]

        ];

        $table = $this->table('sub_linha_pesquisa');
        $table->insert($subLinhaPesquisa)->save();


        //add Linha de Pesquisa
        $linhaPesquisa = [
            [
                'nome_linha_pesquisa' => 'A Biodiversidade do pantanal e cerrado e suas relações e aplicações na saúde'
            ],
            [
                'nome_linha_pesquisa' => 'Ações de Combate ao COVID-19'
            ],
            [
                'nome_linha_pesquisa' => 'Aquicultura, Produção e Nutrição de Não-Ruminantes'
            ],
            [
                'nome_linha_pesquisa' => 'Aspectos laboratoriais e epidemiológicos das infecções fúngicas, bacterianas e virais'
            ],
            [
                'nome_linha_pesquisa' => 'Aspectos profiláticos e terapêuticos da atividade física em diferentes condições de saúde'
            ],
            [
                'nome_linha_pesquisa' => 'Avaliação da resposta imune celular e humoral'
            ],
            [
                'nome_linha_pesquisa' => 'Biodiversidade do Cerrado e suas aplicações na saúde'
            ],
            [
                'nome_linha_pesquisa' => 'Biologia Molecular e Culturas Celulares'
            ],
            [
                'nome_linha_pesquisa' => 'Biomateriais: estudos da biocompatibilidade e aplicações na saúde'
            ],
            [
                'nome_linha_pesquisa' => 'Bioquímica em estados patológicos'
            ],
            [
                'nome_linha_pesquisa' => 'Biotecnologia'
            ],
            [
                'nome_linha_pesquisa' => 'Biotecnologia aplicada à saúde humana e animal'
            ],
            [
                'nome_linha_pesquisa' => 'Biotecnologia aplicada ao desenvolvimento de produtos, processos e serviços'
            ],
            [
                'nome_linha_pesquisa' => 'Biotecnologia e Biodiversidade'
            ],
            [
                'nome_linha_pesquisa' => 'Carcinogênese experimental e estudos do câncer na Região Centro-Oeste'
            ],
            [
                'nome_linha_pesquisa' => 'Ciência e Tecnologia de Produtos de Origem Animal e Avaliação Econômica e Gestão de Sistemas Agropecuários'
            ],
            [
                'nome_linha_pesquisa' => 'Ciência, Tecnologia e Inovação para Sustentabilidade da Região Centro Oeste'
            ],
            [
                'nome_linha_pesquisa' => 'Clínica e epidemiologia das doenças infecciosas e parasitárias'
            ],
            [
                'nome_linha_pesquisa' => 'Clínica, cirurgia e métodos terapêuticos'
            ],
            [
                'nome_linha_pesquisa' => 'Cultivo celular, terapia e engenharia tecidual'
            ],
            [
                'nome_linha_pesquisa' => 'Desenvolvimento de Produtos, Processos e Serviços Biotecnológicos'
            ],
            [
                'nome_linha_pesquisa' => 'Desenvolvimento de Metodologias Analíticas'
            ],
            [
                'nome_linha_pesquisa' => 'Diagnóstico de mormo (Doença equina causada por Burkholderia mallei)'
            ],
            [
                'nome_linha_pesquisa' => 'Dor, analgesia e cicatrização'
            ],
            [
                'nome_linha_pesquisa' => 'Eco-epidemiologia de vetores de importância sanitária e parasitologia'
            ],
            [
                'nome_linha_pesquisa' => 'Eletrocatálise e Bioeletrocatálise'
            ],
            [
                'nome_linha_pesquisa' => 'Engenharia Biomédica e Tecnologias Assistivas Aplicadas à Saúde'
            ],
            [
                'nome_linha_pesquisa' => 'Epidemiologia e controle de doenças'
            ],
            [
                'nome_linha_pesquisa' => 'Estudo Químico de Plantas e Liquens'
            ],
            [
                'nome_linha_pesquisa' => 'Estudos sobre leishmanioses em Mato Grosso do Sul'
            ],
            [
                'nome_linha_pesquisa' => 'Exercício Físico e Saúde'
            ],
            [
                'nome_linha_pesquisa' => 'Farmacologia da Resposta Inflamatória'
            ],
            [
                'nome_linha_pesquisa' => 'Forragicultura e Pastagens'
            ],
            [
                'nome_linha_pesquisa' => 'Fotoquímica e Eletroquímica Aplicada'
            ],
            [
                'nome_linha_pesquisa' => 'Genomica funcional'
            ],
            [
                'nome_linha_pesquisa' => 'História Natural'
            ],
            [
                'nome_linha_pesquisa' => 'Investigação de Alvos Terapêuticos, Estudos epidemiológicos e Pré-Clínicos'
            ],
            [
                'nome_linha_pesquisa' => 'Investigação de Atividades Biológicas de Produtos Naturais e Sintéticos'
            ],
            [
                'nome_linha_pesquisa' => 'Marcadores moleculares, estudos epidemiológicos e pré-clínicos'
            ],
            [
                'nome_linha_pesquisa' => 'Materiais Aplicados à Saúde'
            ],
            [
                'nome_linha_pesquisa' => 'Materiais e Métodos para Remediação e Controle Ambiental'
            ],
            [
                'nome_linha_pesquisa' => 'Materiais, Sensores e Energia'
            ],
            [
                'nome_linha_pesquisa' => 'Mediadores celulares'
            ],
            [
                'nome_linha_pesquisa' => 'Melhoramento Genético e Reprodução Animal'
            ],
            [
                'nome_linha_pesquisa' => 'Mestrado em Farmácia'
            ],
            [
                'nome_linha_pesquisa' => 'Metabolismo e Nutrição'
            ],
            [
                'nome_linha_pesquisa' => 'Metabolômica'
            ],
            [
                'nome_linha_pesquisa' => 'Modelos animais de doença'
            ],
            [
                'nome_linha_pesquisa' => 'Neurociências'
            ],
            [
                'nome_linha_pesquisa' => 'Neurofarmacologia'
            ],
            [
                'nome_linha_pesquisa' => 'Ortodontia'
            ],
            [
                'nome_linha_pesquisa' => 'Processo saúde-doença na região Centro-Oeste: aspectos biopsicossociais, socioculrurais, ecoambientais, epidemiológicos e clínicos'
            ],
            [
                'nome_linha_pesquisa' => 'Processos de avaliação e modelos de intervenção aplicadas ao desempenho físico e esportivo'
            ],
            [
                'nome_linha_pesquisa' => 'Produção e Nutrição de Ruminantes'
            ],
            [
                'nome_linha_pesquisa' => 'Produtos naturais e inflamação'
            ],
            [
                'nome_linha_pesquisa' => 'Prospecção, síntese, controle de qualidade e desenvolvimento tecnológico de produtos de interesse farmacêutico'
            ],
            [
                'nome_linha_pesquisa' => 'Prospecção, síntese, controle de qualidade, tecnologia farmacêutica e toxicologia'
            ],
            [
                'nome_linha_pesquisa' => 'Psicologia e Processos Comportamentais'
            ],
            [
                'nome_linha_pesquisa' => 'Psicologia e Processos Psicossociais'
            ],
            [
                'nome_linha_pesquisa' => 'Química de Produtos Naturais'
            ],
            [
                'nome_linha_pesquisa' => 'Química dos Combustíveis'
            ],
            [
                'nome_linha_pesquisa' => 'Química dos Materiais'
            ],
            [
                'nome_linha_pesquisa' => 'Química Farmacêutica'
            ],
            [
                'nome_linha_pesquisa' => 'Química Inorgânica: Catálise, Compostos de Coordenação e Aplicações Biológicas'
            ],
            [
                'nome_linha_pesquisa' => 'Química teórica: Simulação Computacional'
            ],
            [
                'nome_linha_pesquisa' => 'Radiação e procedimentos físicos diagnósticos e terapêuticos em saúde'
            ],
            [
                'nome_linha_pesquisa' => 'Reprodução e conservação de material genético'
            ],
            [
                'nome_linha_pesquisa' => 'Reprodução e Melhoramento Animal'
            ],
            [
                'nome_linha_pesquisa' => 'Respostas ao Exercício e Saúde Humana'
            ],
            [
                'nome_linha_pesquisa' => 'Ressonância Magnética Nuclear e Quimiometria'
            ],
            [
                'nome_linha_pesquisa' => 'Síntese Orgânica e Química Medicinal'
            ],
            [
                'nome_linha_pesquisa' => 'Sistemática e Evolução'
            ],
            [
                'nome_linha_pesquisa' => 'Teoria, Instrumentação e Simulação Computacional em Materiais'
            ],
            [
                'nome_linha_pesquisa' => 'Zoologia Experimental e Aplicada'
            ]
        ];

        $table = $this->table('linha_pesquisa');
        $table->insert($linhaPesquisa)->save();


        //add sub_linha_pesquisa_linha_pesquisa
        $subLinhaPesquisaLinhaPesquisa = [

            [
                'sub_linha_pesquisa_id' => 1,
                'linha_pesquisa_id' => 1
            ],
            [
                'sub_linha_pesquisa_id' => 1,
                'linha_pesquisa_id' => 9
            ],
            [
                'sub_linha_pesquisa_id' => 1,
                'linha_pesquisa_id' => 46
            ],
            [
                'sub_linha_pesquisa_id' => 1,
                'linha_pesquisa_id' => 15
            ],
            [
                'sub_linha_pesquisa_id' => 1,
                'linha_pesquisa_id' => 48
            ],
            [
                'sub_linha_pesquisa_id' => 1,
                'linha_pesquisa_id' => 66
            ],
            [
                'sub_linha_pesquisa_id' => 1,
                'linha_pesquisa_id' => 20
            ],
            [
                'sub_linha_pesquisa_id' => 1,
                'linha_pesquisa_id' => 52
            ],
            [
                'sub_linha_pesquisa_id' => 1,
                'linha_pesquisa_id' => 27
            ],
            [
                'sub_linha_pesquisa_id' => 1,
                'linha_pesquisa_id' => 69
            ],
            [
                'sub_linha_pesquisa_id' => 2,
                'linha_pesquisa_id' => 22
            ],
            [
                'sub_linha_pesquisa_id' => 2,
                'linha_pesquisa_id' => 26
            ],
            [
                'sub_linha_pesquisa_id' => 2,
                'linha_pesquisa_id' => 29
            ],
            [
                'sub_linha_pesquisa_id' => 2,
                'linha_pesquisa_id' => 34
            ],
            [
                'sub_linha_pesquisa_id' => 2,
                'linha_pesquisa_id' => 47
            ],
            [
                'sub_linha_pesquisa_id' => 2,
                'linha_pesquisa_id' => 60
            ],
            [
                'sub_linha_pesquisa_id' => 2,
                'linha_pesquisa_id' => 61
            ],
            [
                'sub_linha_pesquisa_id' => 2,
                'linha_pesquisa_id' => 62
            ],
            [
                'sub_linha_pesquisa_id' => 2,
                'linha_pesquisa_id' => 64
            ],
            [
                'sub_linha_pesquisa_id' => 2,
                'linha_pesquisa_id' => 65
            ],
            [
                'sub_linha_pesquisa_id' => 2,
                'linha_pesquisa_id' => 70
            ],
            [
                'sub_linha_pesquisa_id' => 2,
                'linha_pesquisa_id' => 71
            ],
            [
                'sub_linha_pesquisa_id' => 3,
                'linha_pesquisa_id' => 58
            ],
            [
                'sub_linha_pesquisa_id' => 3,
                'linha_pesquisa_id' => 59
            ],
            [
                'sub_linha_pesquisa_id' => 4,
                'linha_pesquisa_id' => 4
            ],
            [
                'sub_linha_pesquisa_id' => 4,
                'linha_pesquisa_id' => 6
            ],
            [
                'sub_linha_pesquisa_id' => 4,
                'linha_pesquisa_id' => 18
            ],
            [
                'sub_linha_pesquisa_id' => 4,
                'linha_pesquisa_id' => 30
            ],
            [
                'sub_linha_pesquisa_id' => 4,
                'linha_pesquisa_id' => 25
            ],
            [
                'sub_linha_pesquisa_id' => 5,
                'linha_pesquisa_id' => 19
            ],
            [
                'sub_linha_pesquisa_id' => 5,
                'linha_pesquisa_id' => 28
            ],
            [
                'sub_linha_pesquisa_id' => 5,
                'linha_pesquisa_id' => 67
            ],
            [
                'sub_linha_pesquisa_id' => 5,
                'linha_pesquisa_id' => 24
            ],
            [
                'sub_linha_pesquisa_id' => 6,
                'linha_pesquisa_id' => 37
            ],
            [
                'sub_linha_pesquisa_id' => 6,
                'linha_pesquisa_id' => 56
            ],
            [
                'sub_linha_pesquisa_id' => 6,
                'linha_pesquisa_id' => 39
            ],
            [
                'sub_linha_pesquisa_id' => 6,
                'linha_pesquisa_id' => 57
            ],
            [
                'sub_linha_pesquisa_id' => 6,
                'linha_pesquisa_id' => 38
            ],
            [
                'sub_linha_pesquisa_id' => 6,
                'linha_pesquisa_id' => 55
            ],
            [
                'sub_linha_pesquisa_id' => 6,
                'linha_pesquisa_id' => 50
            ],
            [
                'sub_linha_pesquisa_id' => 7,
                'linha_pesquisa_id' => 5
            ],
            [
                'sub_linha_pesquisa_id' => 7,
                'linha_pesquisa_id' => 53
            ],
            [
                'sub_linha_pesquisa_id' => 8,
                'linha_pesquisa_id' => 44
            ],
            [
                'sub_linha_pesquisa_id' => 8,
                'linha_pesquisa_id' => 3
            ],
            [
                'sub_linha_pesquisa_id' => 8,
                'linha_pesquisa_id' => 54
            ],
            [
                'sub_linha_pesquisa_id' => 8,
                'linha_pesquisa_id' => 33
            ],
            [
                'sub_linha_pesquisa_id' => 8,
                'linha_pesquisa_id' => 16
            ],
            [
                'sub_linha_pesquisa_id' => 8,
                'linha_pesquisa_id' => 3
            ],
            [
                'sub_linha_pesquisa_id' => 8,
                'linha_pesquisa_id' => 68
            ],
            [
                'sub_linha_pesquisa_id' => 9,
                'linha_pesquisa_id' => 13
            ],
            [
                'sub_linha_pesquisa_id' => 9,
                'linha_pesquisa_id' => 12
            ],
            [
                'sub_linha_pesquisa_id' => 10,
                'linha_pesquisa_id' => 10
            ],
            [
                'sub_linha_pesquisa_id' => 10,
                'linha_pesquisa_id' => 11
            ],
            [
                'sub_linha_pesquisa_id' => 10,
                'linha_pesquisa_id' => 35
            ],
            [
                'sub_linha_pesquisa_id' => 10,
                'linha_pesquisa_id' => 43
            ],
            [
                'sub_linha_pesquisa_id' => 11,
                'linha_pesquisa_id' => 72
            ],
            [
                'sub_linha_pesquisa_id' => 11,
                'linha_pesquisa_id' => 36
            ],
            [
                'sub_linha_pesquisa_id' => 11,
                'linha_pesquisa_id' => 74
            ],
            [
                'sub_linha_pesquisa_id' => 12,
                'linha_pesquisa_id' => 17
            ],
            [
                'sub_linha_pesquisa_id' => 12,
                'linha_pesquisa_id' => 21
            ],
            [
                'sub_linha_pesquisa_id' => 13,
                'linha_pesquisa_id' => 40
            ],
            [
                'sub_linha_pesquisa_id' => 13,
                'linha_pesquisa_id' => 41
            ],
            [
                'sub_linha_pesquisa_id' => 13,
                'linha_pesquisa_id' => 42
            ],
            [
                'sub_linha_pesquisa_id' => 13,
                'linha_pesquisa_id' => 73
            ]
        ];

        $table = $this->table('sub_linha_pesquisa_linha_pesquisa');
        $table->insert($subLinhaPesquisaLinhaPesquisa)->save();


        //add Finalidade
        $finalidade = [
            [
                'nome_finalidade' => 'Aula prática'
            ],
            [
                'nome_finalidade' => 'Cirurgia experimental'
            ],
            [
                'nome_finalidade' => 'Controle'
            ],
            [
                'nome_finalidade' => 'Outros'
            ],
            [
                'nome_finalidade' => 'Produtos ou Plantas Naturais'
            ],
            [
                'nome_finalidade' => 'Sangria'
            ],
            [
                'nome_finalidade' => 'Teste com Extratos'
            ],
            [
                'nome_finalidade' => 'Teste de Nutrição'
            ],
            [
                'nome_finalidade' => 'Tratamento c/drogas'
            ]

        ];

        $table = $this->table('finalidade');
        $table->insert($finalidade)->save();


        //add Laboratório
        $laboratorio = [
            [
                'nome_laboratorio' => 'Bioensaios INBIO'
            ],
            [
                'nome_laboratorio' => 'Biofisiofarmacologia'
            ],
            [
                'nome_laboratorio' => 'Biologia Molecular e Culturas Celulares'
            ],
            [
                'nome_laboratorio' => 'Biomol'
            ],
            [
                'nome_laboratorio' => 'Bioquímica Geral e de Microrganismos'
            ],
            [
                'nome_laboratorio' => 'Biotério Central - UFMS'
            ],
            [
                'nome_laboratorio' => 'Biotério UCDB'
            ],
            [
                'nome_laboratorio' => 'Carcinogêse Experimental'
            ],
            [
                'nome_laboratorio' => 'CIVET'
            ],
            [
                'nome_laboratorio' => 'Fisiologia - Uniderp'
            ],
            [
                'nome_laboratorio' => 'LABFAR - Laboratório de Farmacologia e Inflamação'
            ],
            [
                'nome_laboratorio' => 'Laboratório de Bioquímica Geral e de Microrganismos'
            ],
            [
                'nome_laboratorio' => 'Laboratório de Nanomateriais e Nanotecnologia Aplicada'
            ],
            [
                'nome_laboratorio' => 'Laboratório de Parasitologia Clínica'
            ],
            [
                'nome_laboratorio' => 'Laboratório de Pesquisa de Produtos Naturais Bioativos (PRONABio)'
            ],
            [
                'nome_laboratorio' => 'Laboratório Nacional de Biociências - LNBio'
            ],
            [
                'nome_laboratorio' => 'LAPNEM'
            ],
            [
                'nome_laboratorio' => 'LBFF'
            ],
            [
                'nome_laboratorio' => 'LEME - Laboratório de Estudo do Múculo Estriado'
            ],
            [
                'nome_laboratorio' => 'LMED'
            ],
            [
                'nome_laboratorio' => 'LP4 (INQUI - UFMS)'
            ],
            [
                'nome_laboratorio' => 'Metabolismo Mineral'
            ],
            [
                'nome_laboratorio' => 'Parasitologia Humana'
            ],
            [
                'nome_laboratorio' => 'Psicologia Experimental'
            ],
            [
                'nome_laboratorio' => 'Química Farmacêutica'
            ],
            [
                'nome_laboratorio' => 'Química Medicinal'
            ],
            [
                'nome_laboratorio' => 'Sanidade Animal - EMBRAPA'
            ],
            [
                'nome_laboratorio' => 'Toxicologia e Plantas Medicinais'
            ],
            [
                'nome_laboratorio' => 'UNIDERP AGRÁRIAS'
            ]

        ];

        $table = $this->table('laboratorio');
        $table->insert($laboratorio)->save();


        //add Vinculo Institucional
        $vinculoInstitucional = [
            [
                'nome_vinculo_institucional' => 'Aula Graduação Psicologia'
            ],
            [
                'nome_vinculo_institucional' => 'Aula Prática'
            ],
            [
                'nome_vinculo_institucional' => 'Aula Pratica Psicologia'
            ],
            [
                'nome_vinculo_institucional' => 'Biologia Animal'
            ],
            [
                'nome_vinculo_institucional' => 'Biologia Vegetal'
            ],
            [
                'nome_vinculo_institucional' => 'Bioquímica e Biologia Molecular'
            ],
            [
                'nome_vinculo_institucional' => 'Bioquímica e Saúde'
            ],
            [
                'nome_vinculo_institucional' => 'Biotecnologia'
            ],
            [
                'nome_vinculo_institucional' => 'Biotecnologia e Biodiversidade'
            ],
            [
                'nome_vinculo_institucional' => 'Ciencia Animal'
            ],
            [
                'nome_vinculo_institucional' => 'Ciência dos Materiais'
            ],
            [
                'nome_vinculo_institucional' => 'Ciências da Saúde'
            ],
            [
                'nome_vinculo_institucional' => 'Ciências Farmacêuticas'
            ],
            [
                'nome_vinculo_institucional' => 'Ciências Veterinárias '
            ],
            [
                'nome_vinculo_institucional' => 'Cirurgia Geral'
            ],
            [
                'nome_vinculo_institucional' => 'CNPQ'
            ],
            [
                'nome_vinculo_institucional' => 'Doenças Infecciosas e Parasitárias '
            ],
            [
                'nome_vinculo_institucional' => 'Farmácia'
            ],
            [
                'nome_vinculo_institucional' => 'Fármacia e Biologia Animal'
            ],
            [
                'nome_vinculo_institucional' => 'Graduação'
            ],
            [
                'nome_vinculo_institucional' => 'Inbio Projeto de Pesquisa'
            ],
            [
                'nome_vinculo_institucional' => 'Mestrado em odontologia'
            ],
            [
                'nome_vinculo_institucional' => 'Nutrição Experimental'
            ],
            [
                'nome_vinculo_institucional' => 'PNPD Institucional'
            ],
            [
                'nome_vinculo_institucional' => 'PPI'
            ],
            [
                'nome_vinculo_institucional' => 'Psicologia'
            ],
            [
                'nome_vinculo_institucional' => 'Quimica'
            ],
            [
                'nome_vinculo_institucional' => 'Residência Médica'
            ],
            [
                'nome_vinculo_institucional' => 'Residência Multiprofissional'
            ],
            [
                'nome_vinculo_institucional' => 'Retirada Externa'
            ],
            [
                'nome_vinculo_institucional' => 'Saúde Coletiva e Produtos Naturais'
            ],
            [
                'nome_vinculo_institucional' => 'Saúde e Desenvolvimento'
            ],
            [
                'nome_vinculo_institucional' => 'TCC'
            ],
            [
                'nome_vinculo_institucional' => 'Tcc Curso de Alimentos'
            ],
            [
                'nome_vinculo_institucional' => 'TCC FAMED'
            ],
            [
                'nome_vinculo_institucional' => 'TCC nutrição'
            ],
            [
                'nome_vinculo_institucional' => 'UFGD'
            ],
            [
                'nome_vinculo_institucional' => 'UFMS'
            ],
            [
                'nome_vinculo_institucional' => 'Uniderp'
            ],
            [
                'nome_vinculo_institucional' => 'Unigran'
            ],
            [
                'nome_vinculo_institucional' => 'Pesquisa em Energia e Materiais'
            ],
            [
                'nome_vinculo_institucional' => 'Embrapa'
            ],
        ];

        $table = $this->table('vinculo_institucional');
        $table->insert($vinculoInstitucional)->save();


        //add Projeto
        $projeto= [
            [
                'nome_projeto' => 'Ensino'
            ],
            [
                'nome_projeto' => 'Extensão'
            ],
            [
                'nome_projeto' => 'Outros'
            ],
            [
                'nome_projeto' => 'Pesquisa'
            ],
        ];

        $table = $this->table('projeto');
        $table->insert($projeto)->save();


        //add Especie
        $especie = [
            [
                'nome_especie' => 'Meriones unguiculatus'// sem
            ],
            [
                'nome_especie' => 'Mesocricetus auratus' // GOLDEN
            ],
            [
                'nome_especie' => 'Monodelphis domestica' // sem
            ],
            [
                'nome_especie' => 'Mus musculus'
            ],
            [
                'nome_especie' => 'Rattus norvegicus' // WISTAR
            ]
        ];

        $table = $this->table('especie');
        $table->insert($especie)->save();


        //add Linhagem
        $linhagem = [
            [
                'nome_linhagem' => 'BALB/c'
            ],
            [
                'nome_linhagem' => 'BLACK C57/BL6'
            ],
            [
                'nome_linhagem' => 'GOLDEN'
            ],
            [
                'nome_linhagem' => 'Hamster'
            ],
            [
                'nome_linhagem' => 'HRS/J'
            ],
            [
                'nome_linhagem' => 'SWISS'
            ],
            [
                'nome_linhagem' => 'WISTAR'
            ],
            [
                'nome_linhagem' => 'NOD'
            ],
            [
                'nome_linhagem' => 'NUDE'
            ],
            [
                'nome_linhagem' => 'NSG'
            ],
            [
                'nome_linhagem' => 'GFP'
            ],
            [
                'nome_linhagem' => 'HAIRLESS'
            ],
            [
                'nome_linhagem' => 'C57BL/6'
            ]

        ];

        $table = $this->table('linhagem');
        $table->insert($linhagem)->save();


        //add Especie Linhagem
        $especieLinhagem = [
            [
                'especie_id' => 4,
                'linhagem_id' => 6
            ],
            [
                'especie_id' => 4,
                'linhagem_id' => 1
            ],
            [
                'especie_id' => 4,
                'linhagem_id' => 13
            ],
            [
                'especie_id' => 4,
                'linhagem_id' => 12
            ],
            [
                'especie_id' => 4,
                'linhagem_id' => 9
            ],
            [
                'especie_id' => 4,
                'linhagem_id' => 8
            ],
            [
                'especie_id' => 4,
                'linhagem_id' => 10
            ],
            [
                'especie_id' => 4,
                'linhagem_id' => 11
            ],
            [
                'especie_id' => 2,
                'linhagem_id' => 3
            ],
            [
                'especie_id' => 5,
                'linhagem_id' => 7
            ]
        ];

        $table = $this->table('especie_linhagem');
        $table->insert($especieLinhagem)->save();

    }
}
