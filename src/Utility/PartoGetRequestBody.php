<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Utility;

/**
 * Description of PartoGetRequestBody
 *
 * @author Leonardo
 */
class PartoGetRequestBody {

    public $numero_parto;
    public $data_parto;
    public $num_macho;
    public $num_femea;
    public $des_macho;
    public $des_femea;
    public $qtd_canib;
    public $qtd_gamba;
    public $qtd_outros;
    public $parto_matriz;
    public $ataDesmame;
    public $totalNascimento;
    public $totalDemamado;
    public $semanaNascimento;
    public $semanaDesmame;

    public function __construct() {
        
    }

    public function getNumero_parto() {
        return $this->numero_parto;
    }

    public function getData_parto() {
        return $this->data_parto;
    }

    public function getNum_macho() {
        return $this->num_macho;
    }

    public function getNum_femea() {
        return $this->num_femea;
    }

    public function getDes_macho() {
        return $this->des_macho;
    }

    public function getDes_femea() {
        return $this->des_femea;
    }

    public function getQtd_canib() {
        return $this->qtd_canib;
    }

    public function getQtd_gamba() {
        return $this->qtd_gamba;
    }

    public function getQtd_outros() {
        return $this->qtd_outros;
    }

    public function getParto_matriz() {
        return $this->parto_matriz;
    }

    public function getAtaDesmame() {
        return $this->ataDesmame;
    }

    public function getTotalNascimento() {
        return $this->totalNascimento;
    }

    public function getTotalDemamado() {
        return $this->totalDemamado;
    }

    public function getSemanaNascimento() {
        return $this->semanaNascimento;
    }

    public function getSemanaDesmame() {
        return $this->semanaDesmame;
    }

    public function setNumero_parto($numero_parto): void {
        $this->numero_parto = $numero_parto;
    }

    public function setData_parto($data_parto): void {
        $this->data_parto = $data_parto;
    }

    public function setNum_macho($num_macho): void {
        $this->num_macho = $num_macho;
    }

    public function setNum_femea($num_femea): void {
        $this->num_femea = $num_femea;
    }

    public function setDes_macho($des_macho): void {
        $this->des_macho = $des_macho;
    }

    public function setDes_femea($des_femea): void {
        $this->des_femea = $des_femea;
    }

    public function setQtd_canib($qtd_canib): void {
        $this->qtd_canib = $qtd_canib;
    }

    public function setQtd_gamba($qtd_gamba): void {
        $this->qtd_gamba = $qtd_gamba;
    }

    public function setQtd_outros($qtd_outros): void {
        $this->qtd_outros = $qtd_outros;
    }

    public function setParto_matriz($parto_matriz): void {
        $this->parto_matriz = $parto_matriz;
    }

    public function setAtaDesmame($ataDesmame): void {
        $this->ataDesmame = $ataDesmame;
    }

    public function setTotalNascimento($totalNascimento): void {
        $this->totalNascimento = $totalNascimento;
    }

    public function setTotalDemamado($totalDemamado): void {
        $this->totalDemamado = $totalDemamado;
    }

    public function setSemanaNascimento($semanaNascimento): void {
        $this->semanaNascimento = $semanaNascimento;
    }

    public function setSemanaDesmame($semanaDesmame): void {
        $this->semanaDesmame = $semanaDesmame;
    }

}
