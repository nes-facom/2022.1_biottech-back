<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Utility;

/**
 * Description of PedidosGetRequestBody
 *
 * @author Leonardo
 */
class PedidosGetRequestBody {

    public $id;
    public $num_previsao;
    public $processo_sei;
    public $equipe_executora;
    public $data_solicitacao;
    public $titulo;
    public $especificar;
    public $exper;
    public $num_ceua;
    public $vigencia_ceua;
    public $num_aprovado;
    public $num_solicitado;
    public $adendo_1;
    public $adendo_2;
    public $sexo;
    public $idade;
    public $peso;
    public $observacoes;
    public $vinculo_institucional;
    public $projeto;
    public $especie;
    public $linha_pesquisa;
    public $nivel_projeto;
    public $laboratorio;
    public $finalidade;
    public $pesquisador;
    public $linhagem;
    public $previsao;
    public $saldoCEUA;
    public $saldoPrevisao;
    public $totalRetirado;
    
    public function __construct() {
       
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

        
    public function getNum_previsao() {
        return $this->num_previsao;
    }

    public function getProcesso_sei() {
        return $this->processo_sei;
    }

    public function getEquipe_executora() {
        return $this->equipe_executora;
    }

    public function getData_solicitacao() {
        return $this->data_solicitacao;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getEspecificar() {
        return $this->especificar;
    }

    public function getExper() {
        return $this->exper;
    }

    public function getNum_ceua() {
        return $this->num_ceua;
    }

    public function getVigencia_ceua() {
        return $this->vigencia_ceua;
    }

    public function getNum_aprovado() {
        return $this->num_aprovado;
    }

    public function getNum_solicitado() {
        return $this->num_solicitado;
    }

    public function getAdendo_1() {
        return $this->adendo_1;
    }

    public function getAdendo_2() {
        return $this->adendo_2;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getIdade() {
        return $this->idade;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function getObservacoes() {
        return $this->observacoes;
    }

    public function getVinculo_institucional() {
        return $this->vinculo_institucional;
    }

    public function getProjeto() {
        return $this->projeto;
    }

    public function getEspecie() {
        return $this->especie;
    }

    public function getLinha_pesquisa() {
        return $this->linha_pesquisa;
    }

    public function getNivel_projeto() {
        return $this->nivel_projeto;
    }

    public function getLaboratorio() {
        return $this->laboratorio;
    }

    public function getFinalidade() {
        return $this->finalidade;
    }

    public function getPesquisador() {
        return $this->pesquisador;
    }

    public function getLinhagem() {
        return $this->linhagem;
    }

    public function getPrevisao() {
        return $this->previsao;
    }

    public function getSaldoCEUA() {
        return $this->saldoCEUA;
    }

    public function getSaldoPrevisao() {
        return $this->saldoPrevisao;
    }

    public function getTotalRetirado() {
        return $this->totalRetirado;
    }

    public function setNum_previsao($num_previsao): void {
        $this->num_previsao = $num_previsao;
    }

    public function setProcesso_sei($processo_sei): void {
        $this->processo_sei = $processo_sei;
    }

    public function setEquipe_executora($equipe_executora): void {
        $this->equipe_executora = $equipe_executora;
    }

    public function setData_solicitacao($data_solicitacao): void {
        $this->data_solicitacao = $data_solicitacao;
    }

    public function setTitulo($titulo): void {
        $this->titulo = $titulo;
    }

    public function setEspecificar($especificar): void {
        $this->especificar = $especificar;
    }

    public function setExper($exper): void {
        $this->exper = $exper;
    }

    public function setNum_ceua($num_ceua): void {
        $this->num_ceua = $num_ceua;
    }

    public function setVigencia_ceua($vigencia_ceua): void {
        $this->vigencia_ceua = $vigencia_ceua;
    }

    public function setNum_aprovado($num_aprovado): void {
        $this->num_aprovado = $num_aprovado;
    }

    public function setNum_solicitado($num_solicitado): void {
        $this->num_solicitado = $num_solicitado;
    }

    public function setAdendo_1($adendo_1): void {
        $this->adendo_1 = $adendo_1;
    }

    public function setAdendo_2($adendo_2): void {
        $this->adendo_2 = $adendo_2;
    }

    public function setSexo($sexo): void {
        $this->sexo = $sexo;
    }

    public function setIdade($idade): void {
        $this->idade = $idade;
    }

    public function setPeso($peso): void {
        $this->peso = $peso;
    }

    public function setObservacoes($observacoes): void {
        $this->observacoes = $observacoes;
    }

    public function setVinculo_institucional($vinculo_institucional): void {
        $this->vinculo_institucional = $vinculo_institucional;
    }

    public function setProjeto($projeto): void {
        $this->projeto = $projeto;
    }

    public function setEspecie($especie): void {
        $this->especie = $especie;
    }

    public function setLinha_pesquisa($linha_pesquisa): void {
        $this->linha_pesquisa = $linha_pesquisa;
    }

    public function setNivel_projeto($nivel_projeto): void {
        $this->nivel_projeto = $nivel_projeto;
    }

    public function setLaboratorio($laboratorio): void {
        $this->laboratorio = $laboratorio;
    }

    public function setFinalidade($finalidade): void {
        $this->finalidade = $finalidade;
    }

    public function setPesquisador($pesquisador): void {
        $this->pesquisador = $pesquisador;
    }

    public function setLinhagem($linhagem): void {
        $this->linhagem = $linhagem;
    }

    public function setPrevisao($previsao): void {
        $this->previsao = $previsao;
    }

    public function setSaldoCEUA($saldoCEUA): void {
        $this->saldoCEUA = $saldoCEUA;
    }

    public function setSaldoPrevisao($saldoPrevisao): void {
        $this->saldoPrevisao = $saldoPrevisao;
    }

    public function setTotalRetirado($totalRetirado): void {
        $this->totalRetirado = $totalRetirado;
    }




}
