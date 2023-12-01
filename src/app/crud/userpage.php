<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header('Location: signin.php');
  exit;
} elseif ($_SESSION['level'] > 1) {
  echo 'No permition to this page';
} else {
  require_once('../includes/head.php');
  require_once('../functions.php');
  $token = $_SESSION['token'];

  $sql = "SELECT * FROM users WHERE token = ?";
  $stmt = conn()->prepare($sql);
  if ($stmt->execute([$token])) {
    $n = $stmt->rowCount();
    if ($n === 1) {
      $r = $stmt->fetch();
      $stmt = null;
    }
  }
?>

  <body>

    <!-- **************************************************************************
-----------------------------Inicio do Header-----------------------------
************************************************************************** -->
    <!-------------------------Incicio da Logobar----------------------------- -->

    <div id="logoBar">

      <div class="logoimage">
        <a href="/app/index.php"><img src="../images/Sem título-1..svg" alt="LOGO"></a>
      </div>
    </div>

    <!-------------------------Fim da Logobar----------------------------- -->
    <!-------------------------Inicio da navbar----------------------------- -->

    <?php require_once('../includes/navbar.php'); ?>

    <!-------------------------Fim da navbar----------------------------- -->
    <!-----------------------------Fim do Header-----------------------------
************************************************************************** -->

    <main>
      <div class="container">
        <div class="tattooer-name">
          <h1>Hi <?php echo $_SESSION['name']; ?></h1>

        </div>
        <div class="container-menu">
          <ul>
            <li id="perfil-cont">
              <h3>Perfil</h3>
            </li>
          </ul>
        </div>

        <div class="tattooer-perfil appear">
          <form action="portfolio.php" method="post">
            <section class="joi">
              <fieldset>
                <ul>
                  <li class="v">
                    <label for="Name">Nome</label>
                    <input type="text" name="name" readonly value="<?php echo !empty($r['username']) ? $r['username'] : null; ?>">
                  </li>
                  <li class="v">
                    <label for="email">Email</label>
                    <input type="email" name="email" readonly value="<?php echo !empty($r['email']) ? $r['email'] : null; ?>">
                  </li>
                  <li class="pictu">
                    <label for="pict">Picture</label>
                    <div class="pic"><?php echo "<img src='../users/$token/$token.jpg?v=" . date('U') . "'>" ?></div>
                  </li>
                </ul>
                <fieldset class="save">
                  <button type="button" class='submit'><a href="../crud/portfolio_perfil.php?s=Perfil&token=<?php echo $r['token']; ?>">Edit</a></button>
                </fieldset>
            </section>
          </form>
        </div>
      </div>
    </main>
    <?php require_once('../includes/footer.php') ?>
  </body>

  </html>

<?php
} ?>