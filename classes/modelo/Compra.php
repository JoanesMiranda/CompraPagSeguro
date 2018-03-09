<?php

/**
 * Description of Compra
 *
 * @author Joanes
 */
class Compra {

    private $nome;
    private $valor;
    private $idlogin;

    function getNome() {
        return $this->nome;
    }

    function getValor() {
        return $this->valor;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function getIdlogin() {
        return $this->idlogin;
    }

    function setIdlogin($idlogin) {
        $this->idlogin = $idlogin;
    }

}
