<?php
declare(strict_types=1);

use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\FrozenTime;
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

        $table = $this->table('nivel_projeto');
        $table->insert($nivelProjeto)->save();


        //add Linha de Pesquisa
        $linhaPesquisa= [
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
                'nome_linha_pesquisa' => 'Clínica e epidemiologia das doenças infecciosas e parasitárias'
            ],
            [
                'nome_linha_pesquisa' => 'Clínica, cirurgia e métodos terapêuticos'
            ],
            [
                'nome_linha_pesquisa' => 'Cultivo celular, terapia e engenharia tecidual'
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
                'nome_linha_pesquisa' => 'Psicologia e Processos Comportamentais'
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

        $table = $this->table('linha-pesquisa');
        $table->insert($linhaPesquisa)->save();


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

    }
}
