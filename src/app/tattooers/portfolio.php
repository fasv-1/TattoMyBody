<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../signin.php');
  exit;
} elseif ($_SESSION['level'] === 1) {
  echo 'No permition to this page';
} else {
  require_once('../includes/head.php');
  require_once('../functions.php');
  $token = $_SESSION['token'];

  $sql = "SELECT * FROM users WHERE token = ? && level >=2";
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

    <main class="portfolio">
      <div class="container">

        <!--*************************************************************************--->
        <!------------------------------------Menu section ----------------------------->
        <!--*************************************************************************--->

        <div class="tattooer-name">
          <h1>Hi <?php echo $_SESSION['name']; ?></h1>

        </div>
        <div class="container-menu">
          <ul>
            <li id="perfil-cont">
              <h3>Perfil</h3>
            </li>
            <li id="img-cont">
              <h3>Imagens</h3>
            </li>
            <li id="news-cont">
              <h3>Noticias</h3>
            </li>
            <li id="contacts-cont">
              <h3>Informação</h3>
            </li>
          </ul>
        </div>

        <!--*************************************************************************--->
        <!------------------------------------Perfil section ----------------------------->
        <!--*************************************************************************--->
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
        <!--*************************************************************************--->
        <!------------------------------------Images section ----------------------------->
        <!--*************************************************************************--->

        <div class="tattooer-images">
          <section class="joi">

            <!--*************************************************************************--->
            <!------------------------------------Images section ----------------------------->
            <!--*************************************************************************--->

            <div id="pic-loaded">
              <h2>Imagens carregadas</h2>
              <?php
              $sql = "SELECT * FROM styls WHERE tattooers_token = ? ORDER BY date DESC";
              $stmt = conn()->prepare($sql);


              if ($stmt->execute([$token])) {
                $n = $stmt->rowCount();
                if ($n > 0) {
                  $data = $stmt->fetchAll();
                  $stmt = null;

                  foreach ($data as $s) {
                    $image = $s['token_image']
              ?>
                    <div class="images-upl">
                      <?php echo "<img src='images/$image?v=" . date('U') . "'>" ?>
                      <div class="delimg">
                      <a href="../crud/del.php?s=image&t=styls&token=<?php echo $image;?>" onclick="return confirm('Are you sure you want to delete this record?')">
                        <svg viewBox="0 0 24 24" width="50" height="50">
                          <path fill="currentColor" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-11.414L9.172 7.757 7.757 9.172 10.586 12l-2.829 2.828 1.415 1.415L12 13.414l2.828 2.829 1.415-1.415L13.414 12l2.829-2.828-1.415-1.415L12 10.586z" /></svg>
                      </a>
                      </div>

                    </div>
                  <?php
                  } ?>
                  <p><?php echo $n . '&nbsp;registos'; ?></p>
              <?php
                } else {
                  echo "<h3>Não existem registos</h3>";
                }
              } ?>
            </div>
            <fieldset class="save">
              <button type="button" class='submit'><a href="../crud/image_insertion.php?s=Imagens">Carregar Imagem</a></button>
            </fieldset>
          </section>
        </div>

        <!--*************************************************************************--->
        <!------------------------------------News section ----------------------------->
        <!--*************************************************************************--->
        
          <div class="tattooer-news">
          <section class="joi">
            <div class="have-all">
              <div class="section-title">
                <div>
                  <a class="addbtn" href="../crud/creat_news.php?s=News">
                    <svg viewBox="0 0 24 24" width="24" height="24">
                      <path fill="currentColor" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-11H7v2h4v4h1v-4h4v-2h-4V7h-2v4z" /></svg>Add</a>
                </div>
              </div>
              <?php
              $sql = "SELECT * FROM news WHERE tattooers_token = ? ORDER BY date DESC";
              $stmt = conn()->prepare($sql);

              if ($stmt->execute([$token])) {
                $c = $stmt->rowCount();
                if ($c > 0) {
                  $data = $stmt->fetchAll();
                  $stmt = null; ?>
                  <table>
                    <thead>
                      <tr>
                        <th class="center">#</th>
                        <th class="wide">Title</th>
                        <th>Date</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $i = 1;
                      foreach ($data as $n) { ?>
                        <tr>
                          <td class="center"><?php echo $i; ?></td>
                          <td><a href="../crud/creat_news.php?s=news&token=<?php echo $n['token_news']; ?>"><?php echo $n['title']; ?></a></td>
                          <td class="mono"><?php echo date($n['date']); ?></td>
                          <td><?php echo $n['author']; ?></td>
                          <td>

                            <?php
                            $status = $n['validation'];
                            if ($status === 0) {
                              echo "<div class='t$status'>Draft</div>";
                            } elseif ($status === 1) {
                              echo "<div class='t$status'>Review</div>";
                            } elseif ($status === 2) {
                              echo "<div class='t$status'>Published</div>";
                            } else {
                              echo "<div class='t$status'>Archived</div>";
                            }
                            ?>
            </div>
            </td>
            <td>
              <a href="../crud/creat_news.php?s=News&token=<?php echo $n['token_news']; ?>">
                <svg viewBox="0 0 24 24" width="24" height="24">
                  <path fill="currentColor" d="M4.929 21.485l5.846-5.846a2 2 0 1 0-1.414-1.414l-5.846 5.846-1.06-1.06c2.827-3.3 3.888-6.954 5.302-13.082l6.364-.707 5.657 5.657-.707 6.364c-6.128 1.414-9.782 2.475-13.081 5.303l-1.061-1.06zM16.596 2.04l6.347 6.346a.5.5 0 0 1-.277.848l-1.474.23-5.656-5.656.212-1.485a.5.5 0 0 1 .848-.283z" /></svg>
              </a>
            </td>
            <td>
              <a href="../crud/del.php?s=news&t=news&i=<?php echo $n['image']; ?>&token=<?php echo $n['token_news']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">
                <svg viewBox="0 0 24 24" width="24" height="24">
                  <path fill="currentColor" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-11.414L9.172 7.757 7.757 9.172 10.586 12l-2.829 2.828 1.415 1.415L12 13.414l2.828 2.829 1.415-1.415L13.414 12l2.829-2.828-1.415-1.415L12 10.586z" /></svg>
              </a>
            </td>
            </tr>
          <?php
                        $i++;
                      } ?>
          </tbody>
          <tfoot>
            <tr>
              <td></td>
              <td colspan="6"><?php echo $c . '&nbsp;registos'; ?></td>
            </tr>
          </tfoot>
          </table>
      <?php
                } else {
                  echo "<p>Não existem registos. <a href='../crud/creat_news.php?s=News'>Inserir</a></p>";
                }
              } ?>
          </div>
          </section>
      </div>
      

      <!--*************************************************************************--->
      <!------------------------------------Information section ----------------------------->
      <!--*************************************************************************--->

      <div class="tattooer-contacts">
        <form action="#" method="post">
          <section class="joi">
            <fieldset>
              <ul>
                <li class="descrip">
                  <label for="description">Descrição</label>
                  <textarea rows="5" readonly name="description"><?php echo !empty($q['description']) ? $q['description'] : null; ?></textarea>
                </li>
                <li class="v">
                  <label for="selphone">Telemóvel</label>
                  <input type="text" readonly name="selphone" value="<?php echo !empty($q['selphone']) ? $q['selphone'] : null; ?>">
                </li>
                <li class="v">
                  <label for="adress">Morada</label>
                  <input type="text" readonly name="adress" value="<?php echo !empty($q['adress']) ? $q['adress'] : null; ?>">
                </li>
                <li class="v">
                  <label for="city">Cidade</label>
                  <input type="text" readonly name="city" value="<?php echo !empty($q['city']) ? $q['city'] : null; ?>">
                </li>
                <li class="v">
                  <label for="country">País</label>
                  <input type="text" readonly name="country" value="<?php echo !empty($q['country']) ? $q['country'] : null; ?>">
                </li>
                <fieldset class="social-media">
                  <h2>Social Media</h2>
                  <li class="v">
                    <label for="instagram">Instagram</label>
                    <input type="text" readonly name="instagram" value="<?php echo !empty($q['instagram']) ? $q['instagram'] : null; ?>">
                  </li>
                  <li class="v">
                    <label for="facebook">Facebook</label>
                    <input type="text" readonly name="facebook" value="<?php echo !empty($q['facebook']) ? $q['facebook'] : null; ?>">
                  </li>
                  <li class="v">
                    <label for="twitter">Twitter</label>
                    <input type="text" readonly name="twitter" value="<?php echo !empty($q['twitter']) ? $q['twitter'] : null; ?>">
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
                    <input type="tel" name="cms" readonly value="<?php echo !empty($q['sizevalue']) ? $q['sizevalue'] : null; ?>"><span>€&nbsp(Optional)</span>
                  </div>
                  <div class="session">
                    <label for="session">
                      <h4>Sessão</h4>
                    </label>
                    <input type="tel" name="session" readonly value="<?php echo !empty($q['sessionvalue']) ? $q['sessionvalue'] : null; ?>"><span>€&nbsp(Optional)</span>
                  </div>
                  <div class="color">
                    <label for="color">
                      <h4>Cor</h4>
                    </label>
                    <input type="tel" name="color" readonly value="<?php echo !empty($q['colorvalue']) ? $q['colorvalue'] : null; ?>"><span>€&nbsp(Optional)</span>
                  </div>
            </fieldset>
            <fieldset class="save">
              <button type="button" class='submit'><a href="../crud/portfolio_contacts.php?s=Informação&token=<?php echo $r['token']; ?>">Edit</a></button>
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