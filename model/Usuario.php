<?php

//Criar a classe
class Usuario 
{
    //Criar proriedades existentes na entidade do Banco de Dados
    private $id;
    private $nome;
    private $senha;
    private $email;
    private $token;
    private $data_cadastro;


    //Criar método construtor com as propriedaes obrigatórias a um usuário
    public function __construct($id, $nome, $senha, $email, $token, $data_cadastro)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->email = $email;
        $this->token = $token;   
        $this->data_cadastro = $data_cadastro;     
    }

    //Criar getters e setters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getToken() {
        return $this->token;
    }

    public function getData(){
        return $this->data_cadastro;
    }

    public function setNome($nome) {
        $nome = $nome;
    }

    public function setSenha($senha) {
        $senha = $senha;
    }

    public function setEmail($email) {
        $email = $email;
    }

    public function setToken($token) {
        $token = $token;
    }
    public function setData($data_cadastro){
        $data_cadastro = $data_cadastro;
    }

    //Opcionalmente, criar o ToString() da classe
}
?>