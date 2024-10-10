<?php
// EmailService.php
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->mail->CharSet = 'UTF-8';
        // Configurações do servidor
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'elojobxcronos@gmail.com';
        $this->mail->Password = 'mhnhcbfdqwywvvbv';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
    }

    public function enviarEmail($to, $subject, $codigoVerificacao) {
        try {
            $this->mail->setFrom('elojobxscronos@gmail.com', 'EloJob Cronos');
            $this->mail->addAddress($to);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $message = '
            <!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        padding: 20px;
                        margin: 0;
                    }
                    .container {
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                        max-width: 600px;
                        margin: auto;
                    }
                    h2 {
                        color: #333;
                        font-size: 24px;
                    }
                    p {
                        color: #555;
                        font-size: 16px;
                    }
                    .code {
                        font-size: 24px;
                        font-weight: bold;
                        color: #000; /* Código em preto */
                        padding: 10px;
                        border: 2px solid #000; /* Borda preta */
                        border-radius: 5px;
                        background-color: #eaeaea; /* Fundo cinza claro */
                        display: inline-block;
                        margin-top: 10px;
                    }
                    .footer {
                        margin-top: 20px;
                        font-size: 12px;
                        color: #777;
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h2>Código de Verificação para Redefinição de Senha</h2>
                    <p>Seu código de verificação para redefinir a senha é:</p>
                    <div class="code">' .  $codigoVerificacao . '</div>
                </div>
            </body>
            </html>
            ';
            $this->mail->Body = $message;
            $this->mail->send();
            return true;
           
        } catch (Exception $e) {
            echo "E-mail não pôde ser enviado. Erro: {$this->mail->ErrorInfo}";
            return false;
            
        }
    }
}