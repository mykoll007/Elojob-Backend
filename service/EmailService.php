<?php
// EmailService.php
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        // Configurações do servidor
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'elojobxcronos@gmail.com';
        $this->mail->Password = 'mhnhcbfdqwywvvbv';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
    }

    public function enviarEmail($to, $subject, $message) {
        try {
            $this->mail->setFrom('elojobxscronos@gmail.com', 'EloJob Cronos');
            $this->mail->addAddress($to);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $message;
            $this->mail->send();
            return true;
           
        } catch (Exception $e) {
            echo "E-mail não pôde ser enviado. Erro: {$this->mail->ErrorInfo}";
            return false;
            
        }
    }
}