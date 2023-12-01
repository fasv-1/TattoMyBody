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
  $news_token = !empty($_GET['token']) ? $_GET['token'] : null;


  $sql = "SELECT * FROM news WHERE token_news = ?";
  $stmt = conn()->prepare($sql);
  if ($stmt->execute([$news_token])) {
    $n = $stmt->rowCount();
    if ($n === 1) {
      $r = $stmt->fetch();
      $stmt = null;
    }
  } ?>

  <body class="portfolio">

    <div id="logoBar">

      <div class="logoimage">
        <a href="/app/index.php"><img src="../images/Sem título-1..svg" alt="LOGO"></a>
      </div>
    </div>

    <?php require_once('../includes/navbar.php'); ?>

    <main>
      <div class="container">
        <div class="tattooer-news appear">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <section class="joi">
              <div class="tattooer-name">
                <h1><?php echo $section; ?></h1>
              </div>
              <fieldset>
                <ul>
                  <li class="descrip">
                    <label for="title">Title</label>
                    <textarea rows="2" name="title"><?php echo !empty($r['title']) ? $r['title'] : null; ?></textarea>
                  </li>
                  <li class="descrip">
                    <label for="summary">Summary</label>
                    <textarea rows="3" name="summary"><?php echo !empty($r['summary']) ? $r['summary'] : null; ?></textarea>
                  </li>
                  <li class="descrip">
                    <label for="body">Body</label>
                    <textarea rows="10" name="body"><?php echo !empty($r['body']) ? $r['body'] : null; ?></textarea>
                  </li>
                  <li class="v">
                    <label for="author">Author</label>
                    <input type="text" name="author" value="<?php echo !empty($r['author']) ? $r['author'] : null; ?>">
                  </li>
                  <li class="pictu">
                    <label for="pict">Picture</label>
                    <input type="file" name="pict" class="custom">
                  </li>
                  <?php
                  if ($n > 0) { ?>
                    <li>
                      <label for="author">Status</label>
                      <select name="status" class="style-option">
                        <option value="0" <?php echo $r['validation'] === 0 ? 'selected' : ''; ?>>Draft</option>
                        <option value="1" <?php echo $r['validation'] === 1 ? 'selected' : ''; ?>>Review</option>
                        <option value="2" <?php echo $r['validation'] === 2 ? 'selected' : ''; ?>>Published</option>
                        <option value="3" <?php echo $r['validation'] === 3 ? 'selected' : ''; ?>>Archived</option>
                      </select>
                    </li>
                  <?php } ?>
                </ul>
              </fieldset>
              <fieldset class="save">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <input type="hidden" name="newsid" value="<?php echo !empty($r['token_news']) ? $r['token_news'] : null; ?>">
                <input type="hidden" name="nrow" value="<?php echo $n ?>">

                <input type="submit" value="Guardar" class='submit'>
              </fieldset>
            </section>
          </form>
        </div>
        <?php
        if (!empty($_POST)) {
          $title      = $_POST['title'];
          $summary    = $_POST['summary'];
          $body       = $_POST['body'];
          $author     = $_POST['author'];
          $token      = $_POST['token'];
          $nrow       = $_POST['nrow'];

          $status     = !empty($_POST['status']) ? $_POST['status'] : 0;
          $newsid     = !empty($_POST['newsid']) ? $_POST['newsid'] : sha1(bin2hex(date('U')));
          $timestamp  = date('c');

          $dir        = "../tattooers/news_images/";

          $case = 'tattooers/news_images';


          $pict       = $_FILES['pict']['name'];


          $allows_pic  = array('png', 'jpg', 'jpeg', 'gif', 'svg', 'JPG');
          $allows_size = 1048576 * 2;

          $extPic    = pathinfo($pict, PATHINFO_EXTENSION);

          $path     = $dir . basename("$newsid.$extPic");
          $imgname = "$newsid.$extPic";

          if (!empty($title) && !empty($body)) {
            if (in_array($extPic, $allows_pic)) {
              if ($_FILES["pict"]["size"] > $allows_size) {
                echo "Uploaded file is huge";
              } else {
                if (!empty($_POST['newsid'])) {
                  $sql = "UPDATE news SET title = ?, summary = ?, body = ?, author = ?, image = ?, validation = ? WHERE token_news = ?";

                  $stmt = conn()->prepare($sql);
                  $stmt->bindValue(1, $title, PDO::PARAM_STR);
                  $stmt->bindValue(2, $summary, PDO::PARAM_STR);
                  $stmt->bindValue(3, $body, PDO::PARAM_STR);
                  $stmt->bindValue(4, $author, PDO::PARAM_STR);
                  $stmt->bindValue(5, $imgname, PDO::PARAM_STR);
                  $stmt->bindValue(6, $status, PDO::PARAM_INT);
                  $stmt->bindValue(7, $newsid, PDO::PARAM_STR);
                } else {
                  $sql = "INSERT INTO news (title, summary, body, author, image, validation, date, token_news, tattooers_token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                  $stmt = conn()->prepare($sql);
                  $stmt->bindValue(1, $title, PDO::PARAM_STR);
                  $stmt->bindValue(2, $summary, PDO::PARAM_STR);
                  $stmt->bindValue(3, $body, PDO::PARAM_STR);
                  $stmt->bindValue(4, $author, PDO::PARAM_STR);
                  $stmt->bindValue(5, $imgname, PDO::PARAM_STR);
                  $stmt->bindValue(6, $status, PDO::PARAM_INT);
                  $stmt->bindValue(7, $timestamp, PDO::PARAM_STR);
                  $stmt->bindValue(8, $newsid, PDO::PARAM_STR);
                  $stmt->bindValue(9, $token, PDO::PARAM_STR);
                }


                if ($stmt->execute()) {
                  $stmt = null;
                  move_uploaded_file($_FILES["pict"]["tmp_name"], $path);
                  header("Location: ../tattooers/portfolio.php");
                  ob_end_flush();
                  exit;
                }
              }
            } else {
              echo "extencion not supported";
            }
          } else {
            echo "Some fields are required";
          }
        } ?>
      </div>
    </main>
    <?php require_once('../includes/footer.php'); ?>

  </body>

  </html>


<?php
} ?>