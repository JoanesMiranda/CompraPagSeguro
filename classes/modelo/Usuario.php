<?php

/**
 * Description of Usuario
 *
 * @author Joanes
 */
class Usuario {
    
    private $nome;
    private $senha;
    
    function getNome() {
        return $this->nome;
    }

    function getSenha() {
        return $this->senha;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

}
