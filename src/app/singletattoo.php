<?php
session_start();
error_reporting(E_ALL);
require_once('includes/head.php');
require_once('functions.php');
$token = !empty($_GET['token']) ? $_GET['token'] : null;

$sql = "SELECT * FROM styls WHERE token_image = ?";
$stmt = conn()->prepare($sql);
if ($stmt->execute([$token])) {
  $n = $stmt->rowCount();
  if ($n === 1) {
    $data = $stmt->fetch();
    $stmt = null;
  }
}
$authortoken = !empty($data['tattooers_token']) ? $data['tattooers_token'] : null;

$sql1 = "SELECT * FROM users WHERE token = ?";
$stmt1 = conn()->prepare($sql1);
if ($stmt1->execute([$authortoken])) {
  $n = $stmt1->rowCount();
  if ($n === 1) {
    $r = $stmt1->fetch();
    $stmt1 = null;
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
  <!----------------------------- Página de foto ----------------------------->

  <main class="singletattoo">
    <section class="photoscont">
      <div class="photopre">
        <?php
/* ------------------------------- imagen da tatuagem------------------------------- */
        $image = !empty($data['token_image']) ? $data['token_image'] : null;
        echo "<img src='tattooers/images/$image'>";
        ?>
      </div>
      <div class="photoinfo">
        <div class="author">
          <h3>Feita por:</h3>
          <?php
/* ------------------------------- informação do tatuador que fez a tatuagem------------------------------- */
          $author = !empty($r['username']) ? $r['username'] : null;
          $avatar = !empty($r['avatar']) ? $r['avatar'] : null;
          $email = !empty($r['email']) ? $r['email'] : null;
          echo "<a href='singletattooer.php?token=$authortoken&name=$author&avatar=$avatar&email=$email'><h4>$author</p></h4></a>";
          echo "<img src='users/$authortoken/$authortoken.jpg' alt='author-img'>";
          ?>
        </div>
        <div class="location">
        <h3>Feita em:</h3>
          <?php
/* ------------------------------- localização onde foi feita ------------------------------- */
          $location = !empty($data['location']) ? $data['location'] : null;
          $date = date('d-m-Y', strtotime($data['date']));
          echo "<a href=''><h4>$location</p></h4></a>";
          ?>
        </div>
        <div class="date">
        <h3>Feita a:</h3>
        <?php echo "<p>$date</p>";?>
        </div>
      </div>

    </section>
    <section class="related">
      <div class="tattoos">
        <h2>Imagens Relacionadas</h2>
        <?php
/* ------------------------------- vai buscar imagens com o mesmo estilo ------------------------------- */
        if(!empty($_POST)){
        $style = $data['style'];
        $sql = "SELECT token_image FROM styls WHERE style = ? AND NOT token_image = ? ORDER BY date DESC";
        $stmt = conn()->prepare($sql);


        if ($stmt->execute([$style, $token])) {
          $n = $stmt->rowCount();
          if ($n > 0) {
            $d = $stmt->fetchAll();
            $stmt = null;
          }
        }

        if ($d){
        foreach ($d as $i) {
          $image = $i['token_image'];
        ?>
          <div id="imgcont">
            <?php echo "<a href='singletattoo.php?token=$image'><img src='tattooers/images/$image'></a>"; ?>
          </div>
        <?php
        } }} else {
          echo "<h4>Não existem imagens relacionadas com esta.</h4>";

        }?>
      </div>
    </section>
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