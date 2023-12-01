<?php
require_once('functions.php');
require_once('includes/head.php');
?>
<!------------------------------- formulário para inicio de sessão ------------------------------->
<body>
  <div id="logon">
    <div class="logoncontainer">
      <a href="index.php"><svg class="xclose" width="30px" height="30px" viewBox="0 0 24 24" style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 1.41421;">
          <rect class="top" x="4" y="6" width="24" height="2"></rect>
          <rect class="bottom" x="4" y="11" width="24" height="2"></rect>
        </svg></a>
      <div class="form">
        <form action="./signin.php" class="log-container in" method="post">
          <img src="./images/Sem título-1..svg" alt="login logo" width="40px" height="40px">
          <h2>Sign-in</h2>
          <section>

            <div>
              <label for="email">Email</label>
              <input class="email" type="email" placeholder="Coloca aqui o teu email" name="email">
            </div>
            <div>
              <label for="password">Password</label>
              <input class="password" type="password" placeholder="Password" name="password">
            </div>

            <ul class="checkboxes">
              <li class="f">
                <input type="submit" class="sendonform">
              </li>
            </ul>
          </section>
          <div class="nolog">
            <p>Ainda não estou registado | <a href="./signup.php">Sign-up</a></p>
            <p>Esqueci-me da password | <a href="./reset.php">Reset Password</a></p>
          </div>
        </form>

        <?php
/* ------------------------------- verifica na base de dados se utilizador está registado ------------------------------- */
        if (!empty($_POST)) {
          $password   = $_POST['password'];
          $email      = $_POST['email'];

          if (!empty($password) && !empty($email)) {
            $sql = "SELECT username, email, password, token, level FROM users WHERE email = ? AND level > ? AND status > ? LIMIT 2";

            $stmt = conn()->prepare($sql);
            if ($stmt->execute([$email, 0, 0])) {
              $n = $stmt->rowCount();
              $r = $stmt->fetch();

              $stmt = null;

              if ($n === 1 && password_verify($password, $r['password'])) {
                session_start();

                $_SESSION['loggedin'] = true;

                $_SESSION['email'] = $r['email'];
                $_SESSION['token'] = $r['token'];
                $_SESSION['level'] = $r['level'];
                $_SESSION['name'] = $r['username'];


/* ------------------------------- direciona consuante o nivel, o utilizador para a página certa ------------------------------- */
                if ($_SESSION['level'] === 2) {

                  header("Location: tattooers/portfolio.php");

                } else {

                  header("Location: index.php");
                  
                }

              } else {
                echo "<script>alert('Algo de errado se passou')</script>";
              }
            }
          } else {
            echo "<script>alert('Todos os campos são requeridos')</script>";
          }
        }
        ?>
      </div>
    </div>
  </div>
</body>

</html>