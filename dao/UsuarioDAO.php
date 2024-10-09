<?php

require_once 'Database.php';
require_once '../model/Usuario.php';

class UsuarioDAO{
    private $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }
    public function create($usuario){
        try{
            $sql = "INSERT INTO usuarios (nome, senha, email, token, data_cadastro) 
            VALUES (:nome, :senha, :email, :token, :data_cadastro)";
            $stmt = $this->db->prepare($sql);

            $data_cadastro = date('Y-m-d H:i:s');

            $stmt->execute([':nome' => $usuario->getNome(),
            ':senha' => $usuario->getSenha(),
            ':email' => $usuario->getEmail(),
            ':token' => $usuario->getToken(),
            ':data_cadastro' => $usuario->getData()
        ]);

            return true;

        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getByEmail($email)
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE Email = :email";
            $stmt = $this->db->prepare($sql);

            $stmt->execute([':email' => $email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario ? new Usuario($usuario['id_cadastro'], $usuario['nome'], $usuario['senha'], $usuario['email'], $usuario['token'], $usuario['data_cadastro']) : null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function updateToken($id, $token)
    {
        try {
            $sql = "UPDATE usuarios SET token = :token WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id, ':token' => $token]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>