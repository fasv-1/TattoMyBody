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
  error_reporting(E_ALL);
  require_once('../includes/head.php');
  require_once('../functions.php');
  $section = !empty($_GET['s']) ? $_GET['s'] : null;
  $token = !empty($_GET['token']) ? $_GET['token'] : null;


  $sql1 = "SELECT * FROM portfoli WHERE tattooers_token = ?";
  $stmt1 = conn()->prepare($sql1);
  if ($stmt1->execute([$token])) {
    $m = $stmt1->rowCount();
    if ($m === 1) {
      $q = $stmt1->fetch();
      $stmt1 = null;
    }
  }


?>

  <body>

    <div id="logoBar">

      <div class="logoimage">
        <a href="/app/index.php"><img src="../images/Sem título-1..svg" alt="LOGO"></a>
      </div>
    </div>

    <?php require_once('../includes/navbar.php'); ?>

    <main>
      <div class="container">
        <div class="tattooer-contacts appear">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <section class="joi">
              <div class="tattooer-name">
                <h1><?php echo $section; ?></h1>
              </div>
              <fieldset>
                <ul>
                  <li class="descrip">
                    <label for="description">Descrição</label>
                    <textarea rows="5" name="description"><?php echo !empty($q['description']) ? $q['description'] : null; ?></textarea>
                  </li>
                  <li class="v">
                    <label for="selphone">Telemóvel</label>
                    <input type="text" name="selphone" value="<?php echo !empty($q['selphone']) ? $q['selphone'] : null; ?>">
                  </li>
                  <li class="v">
                    <label for="adress">Morada</label>
                    <input type="text" name="adress" value="<?php echo !empty($q['adress']) ? $q['adress'] : null; ?>">
                  </li>
                  <li class="v">
                    <label for="city">Cidade</label>
                    <input type="text" name="city" value="<?php echo !empty($q['city']) ? $q['city'] : null; ?>">
                  </li>
                  <li class="v">
                    <label for="country">País</label>
                    <select class="country-btn" id="country" name="country"></select>
                  </li>
                  <fieldset class="social-media">
                    <h2>Social Media</h2>
                    <li class="v">
                      <label for="instagram">Instagram</label>
                      <input type="text" name="instagram" value="<?php echo !empty($q['instagram']) ? $q['instagram'] : null; ?>">
                    </li>
                    <li class="v">
                      <label for="facebook">Facebook</label>
                      <input type="text" name="facebook" value="<?php echo !empty($q['facebook']) ? $q['facebook'] : null; ?>">
                    </li>
                    <li class="v">
                      <label for="twitter">Twitter</label>
                      <input type="text" name="twitter" value="<?php echo !empty($q['twitter']) ? $q['twitter'] : null; ?>">
                    </li>
                  </fieldset>
                </ul>
              </fieldset>
              <fieldset>
                  <div class="pay">
                    <label for="payment">
                      <h2>Orçamentos</h2>
                    </label>
                    <div class="cms">
                      <label for="cms">
                        <h4>Cm's</h4>
                      </label>
                      <input type="tel" name="cms" value="<?php echo !empty($q['sizevalue']) ? $q['sizevalue'] : null; ?>"><span>€&nbsp(Optional)</span>
                    </div>
                    <div class="session">
                      <label for="session">
                        <h4>Sessão</h4>
                      </label>
                      <input type="tel" name="session" value="<?php echo !empty($q['sessionvalue']) ? $q['sessionvalue'] : null; ?>"><span>€&nbsp(Optional)</span>
                    </div>
                    <div class="color">
                      <label for="color">
                        <h4>Cor</h4>
                      </label>
                      <input type="tel" name="color" value="<?php echo !empty($q['colorvalue']) ? $q['colorvalue'] : null; ?>"><span>€&nbsp(Optional)</span>
                    </div>
                  </div>
              </fieldset>
              <fieldset class="style-cont sty">
                <h2>Qual o teu estilo de tatuador</h2>
                <select class="style-option" name="tattoo_style">
                  <?php  ?>
                  <option value="random" <?php echo $q['style'] === 'random' ? 'selected' : 'Random'; ?>>Random</option>
                  <option value="black&grey" <?php echo $q['style'] === 'black&grey' ? 'selected' : 'Black & Grey'; ?>>Black & Grey</option>
                  <option value="dotwork" <?php echo $q['style'] === 'dotwork' ? 'selected' : 'Dotwork'; ?>>Dotwork</option>
                  <option value="japanese" <?php echo $q['style'] === 'japanese' ? 'selected' : 'Japanese'; ?>>Japanese</option>
                  <option value="tribal" <?php echo $q['style'] === 'tribal' ? 'selected' : 'Tribal'; ?>>Tribal</option>
                  <option value="neotradicional" <?php echo $q['style'] === 'neotradicional' ? 'selected' : 'Neo-Tradicional'; ?>>Neo-Tradicional</option>
                  <option value="realismo" <?php echo $q['style'] === 'realismo' ? 'selected' : 'Realismo'; ?>>Realismo</option>
                  <option value="space" <?php echo $q['style'] === 'space' ? 'selected' : 'Space'; ?>>Space</option>
                  <option value="surrealismo" <?php echo $q['style'] === 'surrealismo' ? 'selected' : 'Surrealismo'; ?>>Surrealismo</option>
                  <option value="tradicional" <?php echo $q['style'] === 'tradicional' ? 'selected' : 'Tradicional'; ?>>Tradicional</option>
                  <option value="trashpolka" <?php echo $q['style'] === 'trashpolka' ? 'selected' : 'Trash-Polka'; ?>>Trash-Polka</option>
                  <?php ?>
                </select>
              </fieldset>
              <fieldset class="save">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <input type="hidden" name="mrow" value="<?php echo $m; ?>">
                <input type="submit" value="Guardar" class='submit'>
              </fieldset>
            </section>
          </form>
        </div>
        <?php
        if (!empty($_POST)) {
          $selphone   = $_POST['selphone'];
          $adress     = $_POST['adress'];
          $city       = $_POST['city'];
          $country    = $_POST['country'];
          $instagram  = $_POST['instagram'];
          $facebook   = $_POST['facebook'];
          $twitter    = $_POST['twitter'];
          $tokens      = $_POST['token'];
          $description = $_POST['description'];
          $cms        = $_POST['cms'];
          $session    = $_POST['session'];
          $color      = $_POST['color'];
          $mrow       = intval($_POST['mrow']);
          $tattooer_style   = $_POST['tattoo_style'];



          if (!empty($description) && !empty($selphone) && !empty($adress) && !empty($city) && !empty($country)) {

            if ($mrow === 1) {
              $sql = "UPDATE portfoli SET description = ?, sizevalue = ?, sessionvalue = ?, colorvalue = ?, selphone = ?, adress = ?, city = ?, country = ?, instagram = ?, facebook = ?, twitter = ?, style = ? WHERE tattooers_token = ?";
              $stmt = conn()->prepare($sql);

              if ($stmt->execute([$description, $cms, $session, $color, $selphone, $adress, $city, $country, $instagram, $facebook, $twitter, $tattooer_style, $tokens])) {
                $stmt = null;
              }
            } else {
              $sql = "INSERT INTO portfoli (description, sizevalue, sessionvalue, colorvalue, selphone, adress, city, country, instagram, facebook, twitter, style, tattooers_token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
              $stmt = conn()->prepare($sql);

              if ($stmt->execute([$description, $cms, $session, $color, $selphone, $adress, $city, $country, $instagram, $facebook, $twitter, $tattooer_style, $tokens])) {
                $stmt = null;
              }
            }
            header("Location: ../tattooers/portfolio.php");
            ob_end_flush();
            // echo '<script>window.location = "../tattooers/portfolio.php";</script>';
          } else {
            echo "all the fields are required";
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