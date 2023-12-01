<?php
session_start();
require_once('includes/head.php');
require_once('functions.php');
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
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
  <!-----------------------------Inicio do slideshow----------------------------->

  <main class="Index">
    <section class="opening">
      <div class="slider">
        <div class="slide active" style="background-image: url('images/tattoers.jpg');">
          <div class="container">
            <div class="text">
              <p>Não faças tatuagens à toa, procura os melhores tatuadores ao melhor preço</p>
              <a href="/app/tatuadores.php">Procura aqui</a>
            </div>
          </div>
        </div>
        <div class="slide" style="background-image: url('images/Tattoos.jpg');">
          <div class="container">
            <div class="text">
              <p>Vê aqui as melhores tatuagens dos melhores tatuadores</p>
              <a href="/app/tatuagens.php">Procura aqui</a>
            </div>
          </div>
        </div>
        <div class="slide" style="background-image: url('images/materials.jpg');">
          <div class="container">
            <div class="text">
              <p>Noticias e toda a informação que precisas</p>
              <a href="/app/interesses.php">Procura aqui</a>
            </div>
          </div>
        </div>
      </div>
      <div class="controls">
        <div class="prev"><i class="fas fa-arrow-left"></i></div>
        <div class="next"><i class="fas fa-arrow-right"></i></div>
      </div>
      <div class="dots">
      </div>
    </section>

    <!-----------------------------fim do slideshow----------------------------->
    <!-----------------------------inicio do about----------------------------->
    <div id="aboutcont">
      <div class="about">
        <h1><span>Quem somos</span></h1>
        <h3>TattooMyBody é uma página que visa publicitar os melhores tatuadores do país, facilitando o contacto de novos clientes e divulgar novos artista na área da tatuagem.</h3>
      </div>
    </div>
    <!-----------------------------fim do about----------------------------->


    <!-----------------------------tattos em destaque----------------------------->

    <div id="masonry">
      <h1><span>Tatoos em Destaque</span></h1>
      <div class="picture">
        <?php
        $sql = "SELECT * FROM styls ORDER BY date DESC LIMIT 8";
        $stmt = conn()->prepare($sql);


        if ($stmt->execute()) {
          $n = $stmt->rowCount();
          if ($n > 0) {
            $data = $stmt->fetchAll();
            $stmt = null;
          }
        }




        foreach ($data as $i) {
          $image = $i['token_image'];
          echo "<div><a href='singletattoo.php?token=$image'><img src='tattooers/images/$image' alt='image'></a></div>";
        }
        ?>
      </div>
    </div>

    <!-----------------------------fim tattos em destaque----------------------------->
    <!-----------------------------tatuadores em destaque----------------------------->

    <div id="tattoersplace">
      <h1><span>Tatuadores em Destaque</span></h1>
      <div id="tattooerscard">
        <div class="tattooercard">
    <!----------------------- vai buscar 6 tatuadores validados ---------------------->
          <?php
          $sql = "SELECT * FROM users WHERE LEVEL = 3 LIMIT 6";
          $stmt = conn()->prepare($sql);


          if ($stmt->execute()) {
            $n = $stmt->rowCount();
            if ($n > 0) {
              $data = $stmt->fetchAll();
              $stmt = null;
            }
          }

          foreach ($data as $l) {
            $name = $l['username']; //nome de utilizador
            $email = $l['email']; //email de utilizador
            $token = $l['token']; //token de utilizador
            $avatar = $l['avatar']; //avatar de utilizador



          ?>
            <div class="card-image">
              <?php echo "<img class='label' src='users/$token/$avatar' alt='image'>"; ?>
            </div>
            <div class="cardtext">
              <div class="text-content">
                <a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>">
                  <h2 class="title"><?php echo $name ?></h2>
                </a>
                <div class="body-text"><?php echo $email ?></div>

      <!----------------------- vai buscar os dados dos tatuadores ao portfolio ---------------------->

                <?php

                $sql = "SELECT * FROM portfoli WHERE tattooers_token = ?";
                $stmt = conn()->prepare($sql);


                if ($stmt->execute([$token])) {
                  $n = $stmt->rowCount();
                  if ($n === 1) {
                    $r = $stmt->fetch();
                    $stmt = null;
                  }
                }
                
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
            <svg class="chevron" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 35" width="30">
              <path d="M5 30L50 5l45 25" fill="none" stroke="#fff" stroke-width="10" /></svg>
        </div>
      <?php

          }
      ?>
      </div>
    </div>
    </div>

    <!---------------------------fim tatuadores em destaque--------------------------->
    <!----------------------------------- Noticias ---------------------------------->

    <div id="interesses">
      <div id="noticias">
        <h1><span>Notícias</span></h1>
      </div>
    </div>

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