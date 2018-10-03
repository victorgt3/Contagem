<?php
class Produto{
    private $descricao;
    private $preco;

    public function __construct($descricao, $preco){
        $this->descricao = $descricao;
        $this->preco = $preco;
    }
    public function getDetalhes(){
        return "O produto {$this->descricao} custa {$this->preco} reais";
    }

    public function setPreco($valor){
        $this->preco = $valor;
    }

    public function setDescricao($valor){
        $this->descricao = $valor;
    }

    public function getPreco(){
        return $this->preco;
    }

    public function getDescricao(){
        return $this->descricao;
    }
}

$p1 = new Produto("livro", 50);

var_dump($p1);


?>