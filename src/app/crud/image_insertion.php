<?php
session_start();
ob_start();
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../signin.php');
  exit;
} elseif ($_SESSION['level'] === 1) {
  echo 'No permition to this page';
}
else {
  require_once('../includes/head.php');
  require_once('../functions.php');
  $section = !empty($_GET['s']) ? $_GET['s'] : null;
  $token = $_SESSION['token'];
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
        <div class="tattooer-images appear">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <section class="joi">
              <div class="tattooer-name">
                <h1><?php echo $section; ?></h1>
              </div>
              <fieldset>
                <ul>
                  <li class="pictu">
                    <label for="picture"><h3>Carrega uma imagem</h3></label>
                    <input type="file" name="picture" class="custom">
                  </li>
                  <li class="v">
                    <label for="location"><h3>Localização onde foi feita a tatuagem</h3><span>(obrigatório)</span></label>
                    <input type="text" name="location" placeholder="Insira a localização aqui">
                  </li>
                </ul>
              </fieldset>
              <fieldset class="style-cont">
                <h2>Escolhe um estilo para a tua tatuagem</h2>
                <select class="style-option" name="tattoo_style">
                  <option value="random">Random</option>
                  <option value="black&grey">Black & Grey</option>
                  <option value="dotwork">Dotwork</option>
                  <option value="japanese">Japanese</option>
                  <option value="tribal">Tribal</option>
                  <option value="neotradicional">Neo-Tradicional</option>
                  <option value="realismo">Realismo</option>
                  <option value="space">Space</option>
                  <option value="surrealismo">Surrealismo</option>
                  <option value="tradicional">Tradicional</option>
                  <option value="trashpolka">Trash-Polka</option>
                </select>
              </fieldset>
              <fieldset class="save">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <input type="submit" value="Guardar" class='submit'>
              </fieldset>
            </section>
          </form>
        </div>
        <?php
        if (!empty($_POST)) {
          $token          = $_POST['token'];
          $location       = htmlentities($_POST['location']);
          $tattoo_style   = $_POST['tattoo_style'];
          $date           = date('c');

          $dir          = "../tattooers/images/"; //lucalização da pagina
          $file         = $_FILES["picture"]["name"]; //vai buscar o ficheiro carregado e neste caso o nome

          $allows_ext   = array('png', 'jpg', 'jpeg', 'gif', 'svg', 'JPG'); //especificações para as extenções
          $allows_size  = 1048576 * 4; //tamanho em bites (1m)

          $ext          = pathinfo($file, PATHINFO_EXTENSION); //vais buscar a extenção do ficheiro

          $img_token    = sha1(date('U'));

          $path         = $dir . basename("$img_token.$ext"); //token concatenado com a extenção

          $logoname     = "$img_token.$ext";

          if (!empty($location)) {
            if (in_array($ext, $allows_ext)) { //o primeiro parametro indica o que é e o segundo indica o que pode ser
              if ($_FILES["picture"]["size"] > $allows_size) { //verifica o tamanho do ficheiro
                echo "<script>alert('ficheiro demasiado grande')</script>";
              } else {
                $sql = "INSERT INTO styls (style, location, date, token_image, tattooers_token) VALUES (?, ?, ?, ?, ?)";
                $stmt = conn()->prepare($sql);

                if ($stmt->execute([$tattoo_style, $location, $date, $logoname, $token])) {
                  $stmt = null;
                  move_uploaded_file($_FILES["picture"]["tmp_name"], $path);
                  header("Location:../tattooers/portfolio.php");
                  ob_end_flush();
                  exit;
                }
              }
            } else {
              echo "<script>alert('imagem carregada não é suportada')</script>";
            }
          } else {
            echo "<script>alert('Deve carregar um ficheiro e inserir uma localização')</script>";
          }
        }
        ?>
      </div>
    </main>
    <?php require_once('../includes/footer.php'); ?>
  </body>

  </html>

<?php
} ?>