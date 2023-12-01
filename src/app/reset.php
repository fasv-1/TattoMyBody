<?php
require_once('functions.php');
require_once('includes/head.php');
?>

<body>
<!------------------------------- formulário para validar se utilizador existe ------------------------------->
  <div id="logon">
    <div class="logoncontainer">
      <a href="index.php"><svg class="xclose" width="30px" height="30px" viewBox="0 0 24 24" style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 1.41421;">
          <rect class="top" x="4" y="6" width="24" height="2"></rect>
          <rect class="bottom" x="4" y="11" width="24" height="2"></rect>
        </svg></a>
      <div class="form">
        <form action="./reset.php" class="log-container in" method="post">
          <img src="./images/Sem título-1..svg" alt="login logo" width="40px" height="40px">
          <h2>Reset Password</h2>
          <section>
            <div>
              <label for="email">Email</label>
              <input class="email" type="email" placeholder="Email" name="email">
            </div>
            <ul class="checkboxes">
              <li class="f">
                <input type="submit" class="sendonform">
              </li>
            </ul>
          </section>
          <div class="nolog">
            <p>Ainda não estou registado | <a href="./signup.php">Sign-up</a></p>
            <p>Afinal não me esqueci nada | <a href="./signin.php">Sign-in</a></p>
          </div>
        </form>
        <?php

/* ------------------------------- verifica na tabela se o utilizador existe e envia um mail para o reencaminhar para a pagina certa ------------------------------- */
        if (!empty($_POST)) {
          $email = $_POST['email'];
          $sql = "SELECT * FROM users WHERE email = ?";

          $stmt = conn()->prepare($sql);
          if ($stmt->execute([$email])) {
            $n = $stmt->rowCount();
            if ($n === 1) {
              $data = $stmt->fetch();
              $stmt = null;
            }
            $token = $data['token'];

            $subject = 'Alteração de password';
            $message = 'Carrega no link para verificares a tua password: <br><b><a href=https://www.tattoomybody.pt/app/change.php?token=' . $token . '&email=' . $email . '>Reset your password</a></b>';
            $output = '<p>Uma mensagem foi enviada para a sua conta ' . $email . '</p>';

            email($email, $subject, $message, $output);
          } else {
            echo "<script>alert('Todos os campos são requeridos')</script>";
          }
        ?>
      </div>
    </div>
  </div>
</body>

</html>

<?php }
?>