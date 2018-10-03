<?php

require_once 'Conexao.php';
require_once 'Funcoes.php';

class Funcionario{
    private $con;
    private $objfunc;
    private $idFuncionario;
    private $nome;
    private $email;
    private $senha;
    private $dataCadastro;


    public function __construct() {
        
        $this->con = new Conexao();
        $this->objfunc = new Funcoes();
    }  
    
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function __get($atributo) {

        return $this->$atributo;
    }

    public function querySelectiona($dado) {
        try{

            $this->idFuncionario = $this->objfunc->base64($dado, 2);
            $cst = $this->con->conectar()->prepare("SELECT 'idFuncionario', 'nome', 'email', 'email' FROM 'funcionario' WHERE 'idFuncionario' = :idFunc; ");
            $cst->bindParam(":idFunc", $this->idFuncionario, PDO::PARAM_INT);
            $cst->execute();      
            return $cst->fetch();

        }catch(PDOException $ex) {
            return 'error';$ex->getMessage();
        }
    }

    public function querySelect() {
        try{
            $cst = $this->con->conectar()->prepare("SELECT 'idFuncionario', 'nome', 'email', 'email' FROM 'funcionario'; ");
            $cst->execute();
            return $cst->fetchALL();
        }catch(PDOException $ex) {
            return 'error';$ex->getMessage();
        }
    }

    public function queryInsert($dados) {
        try{

            $this->nome = $this->objfunc->tratarCaracter($dados['nome'], 1);
            $this->email = $dados['email'];
            $this->senha = sha1($dados['email']);
            $this->dataCadastro = $this->objfunc->dataAtual(2);
            $cst = $this->con->conectar()->prepare("INSERT INTO 'funcionario' ('nome', 'email', 'data_cadastro') VALUES (:nome, :email, :senha, :data);");
            $cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $cst->bindParam(":email", $this->email, PDO::PARAM_STR);
            $cst->bindParam(":senha", $this->senha, PDO::PARAM_STR);
            $cst->bindParam(":data", $this->dataCadastro, PDO::PARAM_STR);
            if($cst->execute()) {
                return 'ok';
            }else{
                return 'erro';
            }




        }catch(PDOException $ex) {
            return 'error';$ex->getMessage();
        }
    }

    public function queryUpdate($dados) {
        try{

            $this->idFuncionario = $this->objfunc->base64($dados['func'], 2);
            $this->nome = $this->objfunc->tratarCaracter($dados['nome'], 1);
            $this->email = $dados['email'];
            $cst = $this->con->conectar()->prepare("UPDATE 'funcionario' SET 'nome' = :nome, 'email' = :email WHERE 'idFuncionario' = :idFunc; ");
            $cst->bindParam(":idFunc", $this->idFuncionario, PDO::PARAM_INT);
            $cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $cst->bindParam(":email", $this->email, PDO::PARAM_STR);
            if($cst->execute()) {
                return 'ok';
            }else{
                return 'erro';
            }
        }catch(PDOException $ex) {
            return 'error';$ex->getMessage();
        }
    }

    public function queryDelete($dados) {
        try{

            $this->idFuncionario = $this->objfunc->base64($dados, 2);
            $cst = $this->con->conectar()->prepare("DELETE FROM 'funcionario' WHERE 'idFuncionario' = :idFunc; ");
            $cst->bindParam(":idFunc", $this->idFuncionario, PDO::PARAM_INT);
            if($cst->execute()) {
                return 'ok';
            }else{
                return 'erro';
            }
        }catch(PDOException $ex) {
            return 'error';$ex->getMessage();
        }
    }
}

?>