<?php

//Criar a classe
class Usuario 
{
    // Criar propriedades existentes na entidade do Banco de Dados
    private $id;
    private $nome;
    private $senha;
    private $email;
    private $telefone;
    private $token;
    private $data_cadastro;
    private $codigo_verificacao;

    // Criar método construtor com as propriedades obrigatórias a um usuário
    public function __construct($id, $nome, $senha, $email, $token, $data_cadastro, $codigo_verificacao = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->email = $email;
        $this->token = $token;   
        $this->data_cadastro = $data_cadastro;
        $this->codigo_verificacao = $codigo_verificacao;     
    }

    // Criar getters
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
    public function getTelefone() {
        return $this->telefone;
    }

    public function getToken() {
        return $this->token;
    }

    public function getDataCadastro() {
        return $this->data_cadastro;
    }
    public function getByCodigoVerificacao() {
        return $this->codigo_verificacao;
    }

    // Criar setters
    public function setNome($nome) {
        $this->nome = $nome; 
    }

    public function setSenha($senha) {
        $this->senha = $senha; 
    }

    public function setEmail($email) {
        $this->email = $email; 
    }
    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setToken($token) {
        $this->token = $token; 
    }

    public function setData($data_cadastro) {
        $this->data_cadastro = $data_cadastro; 
    }

    // Opcionalmente, criar o toString() da classe
}
?>