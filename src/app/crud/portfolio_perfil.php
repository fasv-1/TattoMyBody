<?php
session_start();
ob_start();
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../signin.php');
  exit;
} else {
  require_once('../includes/head.php');
  require_once('../functions.php');
  $section = !empty($_GET['s']) ? $_GET['s'] : null;
  $token = !empty($_GET['token']) ? $_GET['token'] : null;

  $sql = "SELECT * FROM users WHERE token = ?";
  $stmt = conn()->prepare($sql);
  if ($stmt->execute([$token])) {
    $n = $stmt->rowCount();
    if ($n === 1) {
      $r = $stmt->fetch();
      $stmt = null;
    }
  }


  $sql1 = "SELECT * FROM portfoli WHERE tattooers_token = ?";
  $stmt1 = conn()->prepare($sql1);
  $tattooer = $r['token'];
  if ($stmt1->execute([$tattooer])) {
    $m = $stmt1->rowCount();
    if ($m === 1) {
      $q = $stmt1->fetch();
      $stmt1 = null;
    }
  }


?>

  <body class="portfolio">

    <div id="logoBar">

      <div class="logoimage">
        <a href="/app/index.php"><img src="../images/Sem título-1..svg" alt="LOGO"></a>
      </div>
    </div>

    <?php require_once('../includes/navbar.php'); ?>

    <main>
      <div class="container">
        <div class="tattooer-perfil appear">
          <section class="joi">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

              <div class="tattooer-name">
                <h1><?php echo $section; ?></h1>
              </div>
              <fieldset>
                <ul>
                  <li class="v">
                    <label for="Name">Nome</label>
                    <input type="text" name="name" value="<?php echo !empty($r['username']) ? $r['username'] : null; ?>">
                  </li>
                  <li class="v">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?php echo !empty($r['email']) ? $r['email'] : null; ?>">
                  </li>
                  <li class="pictu">
                    <label for="pict">Picture</label>
                    <input type="file" name="pict" class="custom">
                  </li>
                </ul>
              </fieldset>

              <fieldset class="save">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <input type="submit" value="Guardar" class='submit'>
              </fieldset>
            </form>
          </section>
        </div>
        <?php
        if (!empty($_POST)) {
          $name         = $_POST['name'];
          $email        = $_POST['email'];
          $token        = $_POST['token'];

          $dir          = "../users/$token/"; //lucalização da pagina
          $file         = $_FILES["pict"]["name"]; //vai buscar o ficheiro carregado e neste caso o nome

          $allows_ext   = array('png', 'jpg', 'jpeg', 'gif', 'svg', ''); //especificações para as extenções
          $allows_size  = 1048576 * 2; //tamanho em bites (1m)

          $ext    = pathinfo($file, PATHINFO_EXTENSION); //vais buscar a extenção do ficheiro

          //$path   = $dir.basename($file);
          $path   = $dir . basename("$token.$ext"); //token concatenado com a extenção

          $logoname = "$token.$ext";

          if (!empty($email) && !empty($name)) {

            if (in_array($ext, $allows_ext)) { //o primeiro parametro indica o que é e o segundo indica o que pode ser
              if ($_FILES["pict"]["size"] > $allows_size) { //verifica o tamanho do ficheiro
                echo "Uploaded file is huge";
              } else {
                if ($_SESSION['level'] > 1) {
                  $sql = "UPDATE users SET username = ?, email = ?, level = ?, avatar = ?  WHERE token = ?";

                  $stmt = conn()->prepare($sql);
                  $stmt->bindValue(1, $name, PDO::PARAM_STR);
                  $stmt->bindValue(2, $email, PDO::PARAM_STR);
                  $stmt->bindValue(3, 3, PDO::PARAM_INT);
                  $stmt->bindValue(4, $logoname, PDO::PARAM_STR);
                  $stmt->bindValue(5, $token, PDO::PARAM_STR);
                } else {
                  $sql = "UPDATE users SET username = ?, email = ?, avatar = ? WHERE token = ?";

                  $stmt = conn()->prepare($sql);
                  $stmt->bindValue(1, $name, PDO::PARAM_STR);
                  $stmt->bindValue(2, $email, PDO::PARAM_STR);
                  $stmt->bindValue(3, $logoname, PDO::PARAM_STR);
                  $stmt->bindValue(4, $token, PDO::PARAM_STR);
                }
                if ($stmt->execute()) {
                  $stmt = null;
                  move_uploaded_file($_FILES["pict"]["tmp_name"], $path);
                } else {
                  echo "something goes rong";
                }
              }
            } else {
              echo "Uploaded file is not a valid image";
            }
            if ($_SESSION['level'] > 1) {
              header("Location: ../tattooers/portfolio.php");
            } else {
              header("Location: userpage.php");
            }
            ob_end_flush();
          } elseif ($password !== $cpassword) {
            echo "Passwords do not match";
          } else {
            echo "All fields are required";
          }
        }
        ?>
      </div>
    </main>

    <?php require_once('../includes/footer.php') ?>
  </body>

  </html>



<?php
} ?>