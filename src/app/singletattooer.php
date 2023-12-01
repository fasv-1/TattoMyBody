<?php
session_start();
error_reporting(E_ALL);
require_once('includes/head.php');
require_once('functions.php');
$token = !empty($_GET['token']) ? $_GET['token'] : null;
$name = !empty($_GET['name']) ? $_GET['name'] : null;
$avatar = !empty($_GET['avatar']) ? $_GET['avatar'] : null;
$email = !empty($_GET['email']) ? $_GET['email'] : null;


$sql = "SELECT * FROM portfoli WHERE tattooers_token = ?";
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

  <?php require_once('includes/logobar.php'); ?>

  <!-------------------------Fim da Logobar----------------------------- -->
  <!-------------------------Inicio da navbar----------------------------- -->

  <?php require_once('includes/navbar.php'); ?>

  <!-------------------------Fim da navbar----------------------------- -->
  <!-- **************************************************************************
-----------------------------Inicio do Main-----------------------------
************************************************************************** -->
  <!----------------------------- Página de tatuador ----------------------------->

  <main class="singletattooer">
    <section class="infocont">
      <div class="tattooer-name">
        <h1><?php echo $name ?></h1>
      </div>
      <div class="tattooercont">
        <div class="tattooerphoto">
          <?php
/* ------------------------------- avatar do tatuador ------------------------------- */
          echo "<img src='users/$token/$avatar'>";
          ?>
        </div>
        <div class="tattooerinfo">
          <div class="adress">
          <h3>Residente em:</h3>
            <?php
/* ------------------------------- info do tatuador ------------------------------- */
            $adress = !empty($r['adress']) ? $r['adress'] : null;
            $city = !empty($r['city']) ? $r['city'] : null;
            $country = !empty($r['country']) ? $r['country'] : null;
            echo "<a href=''><h4>$adress</p></h4></a>";
            echo "<a href=''><h4>$city</p></h4></a>";
            echo "<a href=''><h4>$country</p></h4></a>";
            ?>
          </div>
          <div class="contact">
          <h3>Contacto telefónico:</h3>
            <?php
            $contact = !empty($r['selphone']) ? $r['selphone'] : null;
            echo "<h4>$contact</h4>";
            ?>
          </div>
          <div class="email">
          <h3>Para qualquer assunto:</h3>
            <?php
            echo "<a href=''><h4>$email</p></h4></a>";
            ?>
          </div>
          <div class="social">
          <h3>Redes Sociais:</h3>
            <?php
            $insta = !empty($r['instagram']) ? $r['instagram'] : null;
            $facebook = !empty($r['facebook']) ? $r['facebook'] : null;
            $twitter = !empty($r['twitter']) ? $r['twitter'] : null;

            if ($insta) {
              echo "<a href='$insta'><i class='fab fa-instagram '></i></a>";
            }
            if ($facebook) {
              echo "<a href='$facebook'><i class='fab fa-facebook '></i></a>";
            }
            if ($twitter) {
              echo "<a href='$twitter'><i class='fab fa-twitter '></i></a>";
            }
            ?>
          </div>
        </div>
      </div>

    </section>
    <section class="related">
      <div class="tattoos">
        <h2>Trabalhos deste tatuador</h2>
        <?php
/* ------------------------------- fotos publicadas pelo tatuador ------------------------------- */
        $data = tattooerimage($token);
        if ($data) {
          foreach ($data as $i) {
            $image = $i['token_image'];
        ?>
            <div id="imgcont">
              <?php echo "<a href='singletattoo.php?token=$image'><img src='tattooers/images/$image'></a>"; ?>
            </div>
        <?php
          }
        } else {
          echo "<h4>Não existem imagens relacionadas com esta.</h4>";
        } ?>
      </div>
    </section>

    <!----------------------------------- Fim das Noticias ---------------------------------->
  </main>

  <!-- ************************************************************************
  -----------------------------Fim do Main-----------------------------
  ************************************************************************** -->
  <!-- ************************************************************************
  -----------------------------Inicio do footer-----------------------------
  ************************************************************************** -->
  <?php require_once('includes/footer.php'); ?>

</body>

</html>