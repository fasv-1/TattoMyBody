<?php
require_once('functions.php');
require_once('includes/head.php');
$token = !empty($_GET['token']) ? $_GET['token'] : null;
$email = !empty($_GET['email']) ? $_GET['email'] : null;
?>

<body>
<!------------------------------- formulario para troca de password ------------------------------->
  <div id="logon">
    <div class="logoncontainer">
      <a href="index.php"><svg class="xclose" width="30px" height="30px" viewBox="0 0 24 24" style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 1.41421;">
          <rect class="top" x="4" y="6" width="24" height="2"></rect>
          <rect class="bottom" x="4" y="11" width="24" height="2"></rect>
        </svg></a>
      <div class="form">
        <form action="change.php" class="log-container in" method="post">
          <img src="./images/Sem título-1..svg" alt="login logo" width="40px" height="40px">
          <h2>Reset Password</h2>
          <section>
            <div>
              <label for="password">Password</label>
              <input class="password" type="password" placeholder="Password" name="password">
            </div>
            <div>
              <label for="cpassword">Confirmação de password</label>
              <input class="cpassword" type="password" placeholder="Password" name="cpassword">
            </div>
            <ul class="checkboxes">
              <li class="f">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <input type="hidden" name="email" value="<?php echo $email ?>">
                <input type="submit" class="sendonform">
              </li>
            </ul>
          </section>
        </form>
        <?php

/* ------------------------------- altera a password na tabela ------------------------------- */
        if (!empty($_POST)) {
          $token = $_POST['token'];
          $email = $_POST['email'];
          $cpassword = $_POST['cpassword'];
          $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
          if (!empty($_POST['cpassword']) && $cpassword != $password) {

            $sql = "UPDATE users SET password = ? WHERE token = ?";

            $stmt = conn()->prepare($sql);
            if ($stmt->execute([$password, $token])) {
              $stmt = null;
              echo "<p>Password alterada</p>";
            } else {
             echo "Error";
            }
          } else {
            echo "<script>alert('Passwords não coincidem')</script>";
          }
        } else {
          echo "<script>alert('Parametros de confirmação em falta')</script>";
        }
        ?>
      </div>
    </div>
  </div>
</body>

</html>