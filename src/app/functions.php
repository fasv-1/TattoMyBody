<?php

/* -------------------- PDO MySQL ligação a base de dados ------------------- */

function conn()
{
    $host = 'localhost';
    $db   = 'tattoomybody';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        return $pdo;
        $pdo = null;
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
}


/* ------------------------------- PhP Mailer ------------------------------- */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function email($to, $subject, $message, $output)
{
    require '../vendor/autoload.php';
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'filipeasvicente@gmail.com';
        $mail->Password   = '*************';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('filipeasvicente@gmail.com', 'Administração');
        $mail->addAddress($to);
        $mail->addReplyTo('no-reply@app.com', 'Information');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        //$mail->AltBody = 'Copy-past this code somewhere: '.$token;

        $mail->send();
        echo $output;
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}

/* ------------------------------- imagens das tatuagens por estilo ------------------------------- */

function image($style)
{
    $sql = "SELECT token_image FROM styls WHERE style = ? ORDER BY date DESC";
    $stmt = conn()->prepare($sql);


    if ($stmt->execute(["$style"])) {
        $n = $stmt->rowCount();
        if ($n > 0) {
            $data = $stmt->fetchAll();
            $stmt = null;
            return $data;
        }
    }
}

/* ------------------------------- dados dos tatuadores por estilo da tabela portfolio ------------------------------- */
function tattooer($item)
{
    $sql = "SELECT * FROM portfoli WHERE style = ? ORDER BY id DESC";
    $stmt = conn()->prepare($sql);


    if ($stmt->execute(["$item"])) {
        $n = $stmt->rowCount();
        if ($n > 0) {
            $data = $stmt->fetchAll();
            $stmt = null;
            return $data;
        }
    }
}

/* ------------------------------- imagens das tatuagens por estilo ------------------------------- */
function tattooerimage($token)
{
    $sql = "SELECT token_image FROM styls WHERE tattooers_token = ? ";
    $stmt = conn()->prepare($sql);


    if ($stmt->execute(["$token"])) {
        $n = $stmt->rowCount();
        if ($n > 0) {
            $data = $stmt->fetchAll();
            $stmt = null;
            return $data;
        }
    }
}

/* ------------------------------- dados dos utilizadores ------------------------------- */
function tattooername($token)
{
    $sql = "SELECT * FROM users WHERE token = ? ";
    $stmt = conn()->prepare($sql);


    if ($stmt->execute(["$token"])) {
        $n = $stmt->rowCount();
        if ($n === 1) {
            $data = $stmt->fetch();
            $stmt = null;
            return $data;
        }
    }
}
