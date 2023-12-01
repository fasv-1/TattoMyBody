<?php
/* ------------------------------- Mostra a informação das noticias introduzidas ------------------------------- */

session_start();
require_once('includes/head.php');
require_once('functions.php');
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

$token = !empty($_GET['token']) ? $_GET['token'] : null;

$sql = "SELECT * FROM news WHERE token_news = ?";
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
<?php require_once('includes/logobar.php'); ?>
  <?php require_once('includes/navbar.php'); ?>
  <main>
    <div class="newcont">
      <div class="title">
        <h1><?php echo !empty($r['title']) ? $r['title'] : null;?></h1>
      </div>
      <div class="author">
        <p><?php echo !empty($r['author']) ? $r['author'] : null;?></p>
        <p><?php echo !empty($r['date']) ? $r['date'] : null;?></p>
      </div>
      <div class="summary">
        <h3><?php echo !empty($r['summary']) ? $r['summary'] : null;?></h3>
      </div>
      <div class="newimg">
        <?php
        $newsimage = !empty($r['image']) ? $r['image'] : null;
        echo "<img src='tattooers/news_images/$newsimage' alt='new-image'>"
        ?>
      </div>
      <div class="body">
        <p><?php echo !empty($r['body']) ? $r['body'] : null;?></p>
      </div>

    </div>
  </main>


</body>
<?php require_once('includes/footer.php'); ?>

</html>