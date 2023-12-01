<?php
require_once('functions.php');
require_once('includes/head.php');
?>

<body>
  <?php
  if (!empty($_GET['token']) && !empty($_GET['email'])) {
    $token   = $_GET['token'];
    $email   = $_GET['email'];

    $sql1 = "SELECT * FROM users WHERE token = ?";
    $stmt1 = conn()->prepare($sql1);


    if ($stmt1->execute([$token])) {
      $n = $stmt1->rowCount();
      if ($n === 1) {
        $data = $stmt1->fetch();
        $stmt1 = null;
      }
    }

    $tokener = $data['token'];
    $level = $data['level'];

    $sql = "UPDATE users SET level=?, status=? WHERE email=? AND token=? AND status=?; ";

    if ($level > 0) {

      $stmt = conn()->prepare($sql);
      $stmt->bindValue(1, 2, PDO::PARAM_INT);
      $stmt->bindValue(2, 1, PDO::PARAM_INT);
      $stmt->bindValue(3, $email, PDO::PARAM_STR);
      $stmt->bindValue(4, $tokener, PDO::PARAM_STR);
      $stmt->bindValue(5, 0, PDO::PARAM_INT);
    } else {
      $stmt = conn()->prepare($sql);
      $stmt->bindValue(1, 1, PDO::PARAM_INT);
      $stmt->bindValue(2, 1, PDO::PARAM_INT);
      $stmt->bindValue(3, $email, PDO::PARAM_STR);
      $stmt->bindValue(4, $tokener, PDO::PARAM_STR);
      $stmt->bindValue(5, 0, PDO::PARAM_INT);
    }
    if ($stmt->execute()) {
      $stmt = null;

      $dir = 'users/' . $token;
      if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
      }

      $subject = 'Conta Verificada';
      $message = '<a href=http://www.tattoomybody.pt/app/signin.php>Loga-te na tua conta</a>';
      $output = '<p>A thank you message has been sent to ' . $email . '</p>';
      header("Location: signin.php");
    }
  } else {
    echo "<script>alert('Parametros de confirmação em falta.');</script>";
  }

  ?>
</body>

</html>