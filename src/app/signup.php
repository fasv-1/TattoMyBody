<?php
require_once('functions.php');
require_once('includes/head.php');
?>

<!------------------------------- formulário para registo de utilizadores ------------------------------->
<body>
  <div id="logon">
    <div class="logoncontainer">
      <a href="index.php"><svg class="xclose" width="30px" height="30px" viewBox="0 0 24 24" style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 1.41421;">
          <rect class="top" x="4" y="6" width="24" height="2"></rect>
          <rect class="bottom" x="4" y="11" width="24" height="2"></rect>
        </svg></a>
      <div class="form">
        <div class="imgform">
        </div>
        <form action="./signup.php" class="log-container" method="post">
          <img src="./images/Sem título-1..svg" alt="login logo" width="40px" height="40px">
          <h2>Sign-up</h2>
          <section>
            <div>
              <label for="username">User Name</label>
              <input class="username" type="text" placeholder="O teu nome" name="username">
            </div>
            <div>
              <label for="email">Email</label>
              <input class="email" type="email" placeholder="Coloca aqui o teu email" name="email">
            </div>
            <div>
              <label for="password">Password</label>
              <input class="password" type="password" placeholder="Password" name="password">
            </div>
            <div>
              <label for="password confirmation">Confirm password</label>
              <input class="password" type="password" placeholder="Confirma password" name="cpassword">
            </div>
            <ul class="checkboxes">
              <li>
                <label class="user-option">Tatuador</label>
                <input type="checkbox" name="tatuador" value="tatuador" id="chektatuador" >
              </li>
              <li>
                <label class="user-option">Utilizador</label>
                <input type="checkbox" name="utilizador" value="utilizador" checked="checked" id="chekutilizador" >
              </li>
              <li class="c">
                <input type="submit" class="sendonform">
              </li>
            </ul>
          </section>
          <div class="nolog">
            <p>Ja tenho uma conta | <a href="./signin.php">Sign-in</a></p>
          </div>
        </form>

        <?php
/* ------------------------------- faz o registo na base de dados por nivel ------------------------------- */
        if (!empty($_POST)) {
          $username   = $_POST['username'];
          $email      = $_POST['email'];
          $password   = $_POST['password'];
          $cpassword  = $_POST['cpassword'];

          if (!empty($email) && !empty($password) && $cpassword == $password) {
            $password   = password_hash($_POST['cpassword'], PASSWORD_BCRYPT);
            $status     = 0;
            $token      = sha1(bin2hex(date('U')));
            $timestamp  = date('U');
            $tatuador = !empty($_POST['tatuador']) ? $_POST['tatuador'] : null;
/* ------------------------------- dependendo da caixa selecionada, faz o registo do nivel ------------------------------- */
            if ($tatuador) {
              $level = 1;
              $sql1 =  "INSERT INTO tattooers (users_token) VALUES (?)";
              $stmt1 = conn()->prepare($sql1);

              if ($stmt1->execute([$token])) {
                $stmt1 = null;
              }
            } else {
              $level = 0;
            }

            $sql = "INSERT INTO users (username, email, password, level, status, token, date) VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = conn()->prepare($sql);
            if ($stmt->execute([$username, $email, $password, $level, $status, $token, $timestamp])) {
              $stmt = null;

              /* ------------------------------- envia um mail de validação para o mail inserido ------------------------------- */
              $subject = 'Verify your account';
              $message = 'Click the link to verify your account: <br><b><a href=http://www.tattoomybody.pt/app/verify-user.php?token=' . $token . '&email=' . $email . '>' . $token . '</a></b>';
              $output = '<p>A confirmation message has been sent to ' . $email . '</p>';

              email($email, $subject, $message, $output);
            }
          } elseif ($password !== $cpassword) {
            echo "<script>alert('As passwords não coincidem')</script>";
          } else {
            echo "<script>alert('Todos os campos são requeridos')</script>";
          }
        }
        ?>

      </div>
    </div>
  </div>
  <script src="/scripts/main.js"></script>
</body>

</html>