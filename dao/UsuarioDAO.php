<?php

require_once 'Database.php';
require_once __DIR__ . '/../model/Usuario.php';

class UsuarioDAO{
    private $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }
    public function create($usuario){
        try{

            // Define o fuso horário para São Paulo
            date_default_timezone_set('America/Sao_Paulo');
            $sql = "INSERT INTO usuarios (nome, senha, email, token, data_cadastro) 
            VALUES (:nome, :senha, :email, :token, :data_cadastro)";
            $stmt = $this->db->prepare($sql);

            // Obtém a data e hora atuais no formato adequado
            $data_cadastro = date('Y-m-d H:i:s');

            $stmt->execute([':nome' => $usuario->getNome(),
            ':senha' => $usuario->getSenha(),
            ':email' => $usuario->getEmail(),
            ':token' => $usuario->getToken(),
            ':data_cadastro' => $data_cadastro
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
            $sql = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $this->db->prepare($sql);

            $stmt->execute([':email' => $email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica se o campo 'telefone' existe nos dados retornados
            $telefone = isset($usuario['telefone']) ? $usuario['telefone'] : null;


            return $usuario ? new Usuario($usuario['id_cadastro'], $usuario['nome'], $usuario['senha'], $usuario['email'], $usuario['token'], $usuario['data_cadastro'], $usuario['telefone'] ?? null) : null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function updateToken($id, $token)
    {
        try {
            $sql = "UPDATE usuarios SET token = :token WHERE id_cadastro = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id, ':token' => $token]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getByToken($token) {
        // Prepara a consulta SQL
        $sql = "SELECT * FROM usuarios WHERE token = :token LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        // Verifica se um usuário foi encontrado
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Usuario(
                $data['id_cadastro'],
                $data['nome'],
                $data['senha'],
                $data['email'],
                $data['token'],
                $data['data_cadastro']
            );
        }

        return null; // Retorna null se nenhum usuário foi encontrado
    }

    public function updateCodigoVerificacao($idUsuario, $codigoVerificacao) {
        $sql = "UPDATE usuarios SET codigo_verificacao = :codigo_verificacao WHERE id_cadastro = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':codigo_verificacao', $codigoVerificacao);
        $stmt->bindValue(':id', $idUsuario);
        $stmt->execute();
    }
    
    public function getByCodigoVerificacao($codigoVerificacao) {
        $sql = "SELECT * FROM usuarios WHERE codigo_verificacao = :codigo_verificacao";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':codigo_verificacao', $codigoVerificacao);
        $stmt->execute();

    // Pega os dados do usuário (se existirem)
    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    // Retorna um novo objeto Usuario com os dados encontrados ou null
    return $dados ? new Usuario(
        $dados['id_cadastro'],
        $dados['nome'],
        $dados['senha'],
        $dados['email'],
        $dados['token'],
        $dados['data_cadastro']
    ) : null;
    }
    

    public function updatePassword($id, $novaSenha) {
        $sql = "UPDATE usuarios SET senha = :senha WHERE id_cadastro = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':senha', $novaSenha);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function update($usuario) {
        try {
            $sql = "UPDATE usuarios SET nome = :nome, email = :email, telefone = :telefone WHERE id_cadastro = :id";
            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':nome' => $usuario->getNome(),
                ':email' => $usuario->getEmail(),
                ':telefone' => $usuario->getTelefone(),
                ':id' => $usuario->getId()
            ]);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getDataCadastroFormatada($email) {
        $usuario = $this->getByEmail($email); // Recupera o usuário pelo email
        if ($usuario) {
            $dataCadastroFormatada = $usuario->getDataCadastro(); // Obtém a data de cadastro
            var_dump($dataCadastroFormatada); // Adiciona um var_dump para verificar o valor
            return $this->formatarDataCadastro($dataCadastroFormatada); // Retorna a data formatada
        }
        return null; 
    }
    
    public function excluirContaPorEmail($email) {
        try {
            $sql = "DELETE FROM usuarios WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':email' => $email]);
            return true; 
        } catch (PDOException $e) {
            return false; 
        }
    }

    private function formatarDataCadastro($dataCadastroFormatada) {
        // Primeiro, garante que a data seja convertida corretamente usando strtotime
        $timestamp = strtotime($dataCadastroFormatada);
        
        // Verifica se o timestamp é válido
        if ($timestamp !== false) {
            $meses = [
                '01' => 'janeiro',
                '02' => 'fevereiro',
                '03' => 'março',
                '04' => 'abril',
                '05' => 'maio',
                '06' => 'junho',
                '07' => 'julho',
                '08' => 'agosto',
                '09' => 'setembro',
                '10' => 'outubro',
                '11' => 'novembro',
                '12' => 'dezembro'
            ];
    
            // Extrai o mês e o ano a partir do timestamp
            $mes = date('m', $timestamp);
            $ano = date('Y', $timestamp);
    
            // Traduz o mês para português
            $mesTraduzido = $meses[$mes];
    
            // Retorna a data formatada
            return "{$mesTraduzido} de {$ano}";
        } else {
            return "Data inválida";
        }
    }
    

}
    


?>