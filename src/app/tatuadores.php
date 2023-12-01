<?php
session_start();
require_once('includes/head.php');
require_once('functions.php');
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
-----------------------------Fim do Header-----------------------------
************************************************************************** -->

  <main class="tatuadores">

    <!-------------------- inicio do menu tatuadores ------------------->

    <div id="tatuadoresmenu">
      <h2>Escolhe o estilo do teu artista</h2>
      <div class="menucontainer">
        <div style=background-image:url(images/black&grey1.jpg)> <a href="./tatuadores.php#blackgrey">
          <div class="overlay">
            <p>Black&Grey</p>
          </div>
          </a>
        </div>
        <div style=background-image:url(images/dotwork1.jpg)> <a href="./tatuadores.php#dotwork">
          <div class="overlay">
            <p>Dotwork</p>
          </div>
          </a>
        </div>
        <div style=background-image:url(images/japanese1.jpg)> <a href="./tatuadores.php#japanese">
          <div class="overlay">
            <p>Japanese</p>
          </div>
          </a>
        </div>
        <div style=background-image:url(images/tribal2.jpg)> <a href="./tatuadores.php#tribal">
          <div class="overlay">
            <p>Tribal</p>
          </div>
          </a>
        </div>
        <div style=background-image:url(images/neo-tradicional1.jpg)> <a href="./tatuadores.php#neotradicional">
          <div class="overlay">
            <p>Neo-tradicional</p>
          </div>
          </a>
        </div>
        <div style=background-image:url(images/realismo2.jpg)> <a href="./tatuadores.php#realismo">
          <div class="overlay">
            <p>Realismo</p>
          </div>
          </a>
        </div>
        <div style=background-image:url(images/space2.jpg)> <a href="./tatuadores.php#space">
          <div class="overlay">
            <p>Space</p>
          </div>
          </a>
        </div>
        <div style=background-image:url(images/surrealismo.jpg)> <a href="./tatuadores.php#surrealismo">
          <div class="overlay">
            <p>Surrealismo</p>
          </div>
          </a>
        </div>
        <div style=background-image:url(images/tradicional34.jpg)> <a href="./tatuadores.php#tradicional">
          <div class="overlay">
            <p>Tradicional</p>
          </div>
          </a>
        </div>
        <div style=background-image:url(images/trash-polka1.jpg)> <a href="./tatuadores.php#trashpolka">
          <div class="overlay">
            <p>Trash-Polka</p>
          </div>
          </a>
        </div>
      </div>
    </div>

    <!-------------------- fim do menu ------------------->
    <!-------------------- inicio do display ------------------->

    <section id="tatuadores">

<!------------------------------- vários ------------------------------->

      <div id="anytattoo">
        <h1>Vários estilos</h1>
        <?php
/* ------------------------------- informação dos tatuadores------------------------------- */

        $qw = 'random';
        $data = tattooer($qw);
        if ($data) {
          foreach ($data as $i) {
            $desc = $i['description'];
            $insta = !empty($i['instagram']) ? $i['instagram'] : null;
            $facebook = !empty($i['facebook']) ? $i['facebook'] : null;
            $twitter = !empty($i['twitter']) ? $i['twitter'] : null;
            $tokeni = $i['tattooers_token'];
            $image = tattooerimage($tokeni);
            $arr = tattooername($tokeni);
            $name = $arr['username'];
            $token = $arr['token'];
            $avatar = $arr['avatar'];
            $email = $arr['email'];

        ?><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>">
              <div class="card">
                <?php

                foreach ($image as $s) {
                  $l = $s['token_image'];
                  $d =  "$l,";

                  $f = explode(",", $d); //coloca tudo num array
                }
                $w = $f[0]; //vai buscar só uma imagem do tatuador


                echo "<img src='tattooers/images/$w' alt='tattooer-tattoo'>" ?>
            </a>
            <div class="cardInfo">
              <div class="tattooerlogo">
                <?php echo "<img src='users/$tokeni/$tokeni.jpg' alt='tattooer-tattoo'>" ?>
              </div>
              <div class="location">
                <h3><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>"><?php echo $name ?></a></h3>
                <p><?php echo $i['city'] ?></p>
            <?php if ($insta) {
              echo "<a href='$insta'><i class='fab fa-instagram '></i></a>";
            }
            if ($facebook) {
              echo "<a href='$facebook'><i class='fab fa-facebook '></i></a>";
            }
            if ($twitter) {
              echo "<a href='$twitter'><i class='fab fa-twitter '></i></a>";
            }
          }
        } ?>
              </div>
            </div>
      </div>
      </div>
<!------------------------------- Black&Grey ------------------------------->
      <div id="blackgrey">
        <h1>Black & Grey</h1>
        <?php

        $qw = 'blackgrey';
        $data = tattooer($qw);
        if ($data) {
          foreach ($data as $i) {
            $desc = $i['description'];
            $insta = !empty($i['instagram']) ? $i['instagram'] : null;
            $facebook = !empty($i['facebook']) ? $i['facebook'] : null;
            $twitter = !empty($i['twitter']) ? $i['twitter'] : null;
            $tokeni = $i['tattooers_token'];
            $image = tattooerimage($tokeni);
            $arr = tattooername($tokeni);
            $name = $arr['username'];
            $token = $arr['token'];
            $avatar = $arr['avatar'];
            $email = $arr['email'];

        ?><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>">
              <div class="card">
                <?php

                foreach ($image as $s) {
                  $l = $s['token_image'];
                  $d =  "$l,";

                  $f = explode(",", $d); //coloca tudo num array
                }
                $w = $f[0]; //vai buscar só uma imagem do tatuador


                echo "<img src='tattooers/images/$w' alt='tattooer-tattoo'>" ?>
            </a>
            <div class="cardInfo">
              <div class="tattooerlogo">
                <?php echo "<img src='users/$tokeni/$tokeni.jpg' alt='tattooer-tattoo'>" ?>
              </div>
              <div class="location">
                <h3><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>"><?php echo $name ?></a></h3>
                <p><?php echo $i['city'] ?></p>
            <?php if ($insta) {
              echo "<a href='$insta'><i class='fab fa-instagram '></i></a>";
            }
            if ($facebook) {
              echo "<a href='$facebook'><i class='fab fa-facebook '></i></a>";
            }
            if ($twitter) {
              echo "<a href='$twitter'><i class='fab fa-twitter '></i></a>";
            }
          }
        } ?>
              </div>
            </div>
      </div>
      </div>
<!------------------------------- Dotwork ------------------------------->
      <div id="dotwork">
        <h1>Dotwork</h1>
        <?php

        $qw = 'dotwork';
        $data = tattooer($qw);
        if ($data) {
          foreach ($data as $i) {
            $desc = $i['description'];
            $insta = !empty($i['instagram']) ? $i['instagram'] : null;
            $facebook = !empty($i['facebook']) ? $i['facebook'] : null;
            $twitter = !empty($i['twitter']) ? $i['twitter'] : null;
            $tokeni = $i['tattooers_token'];
            $image = tattooerimage($tokeni);
            $arr = tattooername($tokeni);
            $name = $arr['username'];
            $token = $arr['token'];
            $avatar = $arr['avatar'];
            $email = $arr['email'];

        ?><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>">
              <div class="card">
                <?php

                foreach ($image as $s) {
                  $l = $s['token_image'];
                  $d =  "$l,";

                  $f = explode(",", $d); //coloca tudo num array
                }
                $w = $f[0]; //vai buscar só uma imagem do tatuador


                echo "<img src='tattooers/images/$w' alt='tattooer-tattoo'>" ?>
            </a>
            <div class="cardInfo">
              <div class="tattooerlogo">
                <?php echo "<img src='users/$tokeni/$tokeni.jpg' alt='tattooer-tattoo'>" ?>
              </div>
              <div class="location">
                <h3><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>"><?php echo $name ?></a></h3>
                <p><?php echo $i['city'] ?></p>
            <?php if ($insta) {
              echo "<a href='$insta'><i class='fab fa-instagram '></i></a>";
            }
            if ($facebook) {
              echo "<a href='$facebook'><i class='fab fa-facebook '></i></a>";
            }
            if ($twitter) {
              echo "<a href='$twitter'><i class='fab fa-twitter '></i></a>";
            }
          }
        } ?>
              </div>
            </div>
      </div>
      </div>
<!------------------------------- Japanese ------------------------------->
      <div id="japanese">
        <h1>Japanese</h1>
        <?php

        $qw = 'japanese';
        $data = tattooer($qw);
        if ($data) {
          foreach ($data as $i) {
            $desc = $i['description'];
            $insta = !empty($i['instagram']) ? $i['instagram'] : null;
            $facebook = !empty($i['facebook']) ? $i['facebook'] : null;
            $twitter = !empty($i['twitter']) ? $i['twitter'] : null;
            $tokeni = $i['tattooers_token'];
            $image = tattooerimage($tokeni);
            $arr = tattooername($tokeni);
            $name = $arr['username'];
            $token = $arr['token'];
            $avatar = $arr['avatar'];
            $email = $arr['email'];

        ?><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>">
              <div class="card">
                <?php

                foreach ($image as $s) {
                  $l = $s['token_image'];
                  $d =  "$l,";

                  $f = explode(",", $d); //coloca tudo num array
                }
                $w = $f[0]; //vai buscar só uma imagem do tatuador


                echo "<img src='tattooers/images/$w' alt='tattooer-tattoo'>" ?>
            </a>
            <div class="cardInfo">
              <div class="tattooerlogo">
                <?php echo "<img src='users/$tokeni/$tokeni.jpg' alt='tattooer-tattoo'>" ?>
              </div>
              <div class="location">
                <h3><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>"><?php echo $name ?></a></h3>
                <p><?php echo $i['city'] ?></p>
            <?php if ($insta) {
              echo "<a href='$insta'><i class='fab fa-instagram '></i></a>";
            }
            if ($facebook) {
              echo "<a href='$facebook'><i class='fab fa-facebook '></i></a>";
            }
            if ($twitter) {
              echo "<a href='$twitter'><i class='fab fa-twitter '></i></a>";
            }
          }
        } ?>
              </div>
            </div>
      </div>
      </div>
<!------------------------------- Tribal ------------------------------->
      <div id="tribal">
        <h1>Tribal</h1>
        <?php

        $qw = 'tribal';
        $data = tattooer($qw);
        if ($data) {
          foreach ($data as $i) {
            $desc = $i['description'];
            $insta = !empty($i['instagram']) ? $i['instagram'] : null;
            $facebook = !empty($i['facebook']) ? $i['facebook'] : null;
            $twitter = !empty($i['twitter']) ? $i['twitter'] : null;
            $tokeni = $i['tattooers_token'];
            $image = tattooerimage($tokeni);
            $arr = tattooername($tokeni);
            $name = $arr['username'];
            $token = $arr['token'];
            $avatar = $arr['avatar'];
            $email = $arr['email'];

        ?><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>">
              <div class="card">
                <?php

                foreach ($image as $s) {
                  $l = $s['token_image'];
                  $d =  "$l,";

                  $f = explode(",", $d); //coloca tudo num array
                }
                $w = $f[0]; //vai buscar só uma imagem do tatuador


                echo "<img src='tattooers/images/$w' alt='tattooer-tattoo'>" ?>
            </a>
            <div class="cardInfo">
              <div class="tattooerlogo">
                <?php echo "<img src='users/$tokeni/$tokeni.jpg' alt='tattooer-tattoo'>" ?>
              </div>
              <div class="location">
                <h3><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>"><?php echo $name ?></a></h3>
                <p><?php echo $i['city'] ?></p>
            <?php if ($insta) {
              echo "<a href='$insta'><i class='fab fa-instagram '></i></a>";
            }
            if ($facebook) {
              echo "<a href='$facebook'><i class='fab fa-facebook '></i></a>";
            }
            if ($twitter) {
              echo "<a href='$twitter'><i class='fab fa-twitter '></i></a>";
            }
          }
        } ?>
              </div>
            </div>
      </div>
      </div>

<!------------------------------- Neo-tradicional ------------------------------->
      <div id="neotradicional">
        <h1>Neo-tradicional</h1>
        <?php

        $qw = 'neotradicional';
        $data = tattooer($qw);
        if ($data) {
          foreach ($data as $i) {
            $desc = $i['description'];
            $insta = !empty($i['instagram']) ? $i['instagram'] : null;
            $facebook = !empty($i['facebook']) ? $i['facebook'] : null;
            $twitter = !empty($i['twitter']) ? $i['twitter'] : null;
            $tokeni = $i['tattooers_token'];
            $image = tattooerimage($tokeni);
            $arr = tattooername($tokeni);
            $name = $arr['username'];
            $token = $arr['token'];
            $avatar = $arr['avatar'];
            $email = $arr['email'];

        ?><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>">
              <div class="card">
                <?php

                foreach ($image as $s) {
                  $l = $s['token_image'];
                  $d =  "$l,";

                  $f = explode(",", $d); //coloca tudo num array
                }
                $w = $f[0]; //vai buscar só uma imagem do tatuador


                echo "<img src='tattooers/images/$w' alt='tattooer-tattoo'>" ?>
            </a>
            <div class="cardInfo">
              <div class="tattooerlogo">
                <?php echo "<img src='users/$tokeni/$tokeni.jpg' alt='tattooer-tattoo'>" ?>
              </div>
              <div class="location">
                <h3><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>"><?php echo $name ?></a></h3>
                <p><?php echo $i['city'] ?></p>
            <?php if ($insta) {
              echo "<a href='$insta'><i class='fab fa-instagram '></i></a>";
            }
            if ($facebook) {
              echo "<a href='$facebook'><i class='fab fa-facebook '></i></a>";
            }
            if ($twitter) {
              echo "<a href='$twitter'><i class='fab fa-twitter '></i></a>";
            }
          }
        } ?>
              </div>
            </div>
      </div>
      </div>

<!------------------------------- Realismo ------------------------------->
      <div id="realismo">
        <h1>Realismo</h1>
        <?php

        $qw = 'realismo';
        $data = tattooer($qw);
        if ($data) {
          foreach ($data as $i) {
            $desc = $i['description'];
            $insta = !empty($i['instagram']) ? $i['instagram'] : null;
            $facebook = !empty($i['facebook']) ? $i['facebook'] : null;
            $twitter = !empty($i['twitter']) ? $i['twitter'] : null;
            $tokeni = $i['tattooers_token'];
            $image = tattooerimage($tokeni);
            $arr = tattooername($tokeni);
            $name = $arr['username'];
            $token = $arr['token'];
            $avatar = $arr['avatar'];
            $email = $arr['email'];

        ?><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>">
              <div class="card">
                <?php

                foreach ($image as $s) {
                  $l = $s['token_image'];
                  $d =  "$l,";

                  $f = explode(",", $d); //coloca tudo num array
                }
                $w = $f[0]; //vai buscar só uma imagem do tatuador


                echo "<img src='tattooers/images/$w' alt='tattooer-tattoo'>" ?>
            </a>
            <div class="cardInfo">
              <div class="tattooerlogo">
                <?php echo "<img src='users/$tokeni/$tokeni.jpg' alt='tattooer-tattoo'>" ?>
              </div>
              <div class="location">
                <h3><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>"><?php echo $name ?></a></h3>
                <p><?php echo $i['city'] ?></p>
            <?php if ($insta) {
              echo "<a href='$insta'><i class='fab fa-instagram '></i></a>";
            }
            if ($facebook) {
              echo "<a href='$facebook'><i class='fab fa-facebook '></i></a>";
            }
            if ($twitter) {
              echo "<a href='$twitter'><i class='fab fa-twitter '></i></a>";
            }
          }
        } ?>
              </div>
            </div>
      </div>
      </div>

<!------------------------------- Space ------------------------------->
      <div id="space">
        <h1>Space</h1>
        <?php

        $qw = 'space';
        $data = tattooer($qw);
        if ($data) {
          foreach ($data as $i) {
            $desc = $i['description'];
            $insta = !empty($i['instagram']) ? $i['instagram'] : null;
            $facebook = !empty($i['facebook']) ? $i['facebook'] : null;
            $twitter = !empty($i['twitter']) ? $i['twitter'] : null;
            $tokeni = $i['tattooers_token'];
            $image = tattooerimage($tokeni);
            $arr = tattooername($tokeni);
            $name = $arr['username'];
            $token = $arr['token'];
            $avatar = $arr['avatar'];
            $email = $arr['email'];

        ?><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>">
              <div class="card">
                <?php

                foreach ($image as $s) {
                  $l = $s['token_image'];
                  $d =  "$l,";

                  $f = explode(",", $d); //coloca tudo num array
                }
                $w = $f[0]; //vai buscar só uma imagem do tatuador


                echo "<img src='tattooers/images/$w' alt='tattooer-tattoo'>" ?>
            </a>
            <div class="cardInfo">
              <div class="tattooerlogo">
                <?php echo "<img src='users/$tokeni/$tokeni.jpg' alt='tattooer-tattoo'>" ?>
              </div>
              <div class="location">
                <h3><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>"><?php echo $name ?></a></h3>
                <p><?php echo $i['city'] ?></p>
            <?php if ($insta) {
              echo "<a href='$insta'><i class='fab fa-instagram '></i></a>";
            }
            if ($facebook) {
              echo "<a href='$facebook'><i class='fab fa-facebook '></i></a>";
            }
            if ($twitter) {
              echo "<a href='$twitter'><i class='fab fa-twitter '></i></a>";
            }
          }
        } ?>
              </div>
            </div>
      </div>

      </div>

<!------------------------------- Surrealismo ------------------------------->
      <div id="surrealismo">
        <h1>Surrealismo</h1>
        <?php

        $qw = 'surrealismo';
        $data = tattooer($qw);
        if ($data) {
          foreach ($data as $i) {
            $desc = $i['description'];
            $insta = !empty($i['instagram']) ? $i['instagram'] : null;
            $facebook = !empty($i['facebook']) ? $i['facebook'] : null;
            $twitter = !empty($i['twitter']) ? $i['twitter'] : null;
            $tokeni = $i['tattooers_token'];
            $image = tattooerimage($tokeni);
            $arr = tattooername($tokeni);
            $name = $arr['username'];
            $token = $arr['token'];
            $avatar = $arr['avatar'];
            $email = $arr['email'];

        ?><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>">
              <div class="card">
                <?php

                foreach ($image as $s) {
                  $l = $s['token_image'];
                  $d =  "$l,";

                  $f = explode(",", $d); //coloca tudo num array
                }
                $w = $f[0]; //vai buscar só uma imagem do tatuador


                echo "<img src='tattooers/images/$w' alt='tattooer-tattoo'>" ?>
            </a>
            <div class="cardInfo">
              <div class="tattooerlogo">
                <?php echo "<img src='users/$tokeni/$tokeni.jpg' alt='tattooer-tattoo'>" ?>
              </div>
              <div class="location">
                <h3><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>"><?php echo $name ?></a></h3>
                <p><?php echo $i['city'] ?></p>
            <?php if ($insta) {
              echo "<a href='$insta'><i class='fab fa-instagram '></i></a>";
            }
            if ($facebook) {
              echo "<a href='$facebook'><i class='fab fa-facebook '></i></a>";
            }
            if ($twitter) {
              echo "<a href='$twitter'><i class='fab fa-twitter '></i></a>";
            }
          }
        } ?>
              </div>
            </div>
      </div>
      </div>

<!------------------------------- Tradicional ------------------------------->
      <div id="tradicional">
        <h1>Tradicional</h1>
        <?php

        $qw = 'tradicional';
        $data = tattooer($qw);
        if ($data) {
          foreach ($data as $i) {
            $desc = $i['description'];
            $insta = !empty($i['instagram']) ? $i['instagram'] : null;
            $facebook = !empty($i['facebook']) ? $i['facebook'] : null;
            $twitter = !empty($i['twitter']) ? $i['twitter'] : null;
            $tokeni = $i['tattooers_token'];
            $image = tattooerimage($tokeni);
            $arr = tattooername($tokeni);
            $name = $arr['username'];
            $token = $arr['token'];
            $avatar = $arr['avatar'];
            $email = $arr['email'];

        ?><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>">
              <div class="card">
                <?php

                foreach ($image as $s) {
                  $l = $s['token_image'];
                  $d =  "$l,";

                  $f = explode(",", $d); //coloca tudo num array
                }
                $w = $f[0]; //vai buscar só uma imagem do tatuador


                echo "<img src='tattooers/images/$w' alt='tattooer-tattoo'>" ?>
            </a>
            <div class="cardInfo">
              <div class="tattooerlogo">
                <?php echo "<img src='users/$tokeni/$tokeni.jpg' alt='tattooer-tattoo'>" ?>
              </div>
              <div class="location">
                <h3><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>"><?php echo $name ?></a></h3>
                <p><?php echo $i['city'] ?></p>
            <?php if ($insta) {
              echo "<a href='$insta'><i class='fab fa-instagram '></i></a>";
            }
            if ($facebook) {
              echo "<a href='$facebook'><i class='fab fa-facebook '></i></a>";
            }
            if ($twitter) {
              echo "<a href='$twitter'><i class='fab fa-twitter '></i></a>";
            }
          }
        } ?>
              </div>
            </div>
      </div>
      </div>
<!------------------------------- Trash-Polka ------------------------------->
      <div id="trashpolka">
        <h1>Trash-Polka</h1>
        <?php

        $qw = 'trashpolka';
        $data = tattooer($qw);
        foreach ($data as $i) {
          $desc = $i['description'];
          $insta = !empty($i['instagram']) ? $i['instagram'] : null;
          $facebook = !empty($i['facebook']) ? $i['facebook'] : null;
          $twitter = !empty($i['twitter']) ? $i['twitter'] : null;
          $tokeni = $i['tattooers_token'];
          $image = tattooerimage($tokeni);
          $arr = tattooername($tokeni);
          $name = $arr['username'];
          $token = $arr['token'];
          $avatar = $arr['avatar'];
          $email = $arr['email'];

        ?><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>">
            <div class="card">
              <?php

              foreach ($image as $s) {
                $l = $s['token_image'];
                $d =  "$l,";

                $f = explode(",", $d); //coloca tudo num array
              }
              $w = $f[0]; //vai buscar só uma imagem do tatuador


              echo "<img src='tattooers/images/$w' alt='tattooer-tattoo'>" ?>
          </a>
          <div class="cardInfo">
            <div class="tattooerlogo">
              <?php echo "<img src='users/$tokeni/$tokeni.jpg' alt='tattooer-tattoo'>" ?>
            </div>
            <div class="location">
              <h3><a href="singletattooer.php?token=<?php echo $token; ?>&name=<?php echo $name; ?>&avatar=<?php echo $avatar; ?>&email=<?php echo $email; ?>>"><?php echo $name ?></a></h3>
              <p><?php echo $i['city'] ?></p>
            <?php if ($insta) {
              echo "<a href='$insta'><i class='fab fa-instagram '></i></a>";
            }
            if ($facebook) {
              echo "<a href='$facebook'><i class='fab fa-facebook '></i></a>";
            }
            if ($twitter) {
              echo "<a href='$twitter'><i class='fab fa-twitter '></i></a>";
            }
          }
            ?>
            </div>
          </div>
      </div>
      </div>
    </section>

    <!-------------------- fim do display------------------->
    <!-------------------- butão para voltar para cima------------------->

    <a class="up" href="./tatuadores.php#logoBar"><svg class="chevron" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 35" width="25">
        <path d="M5 30L50 5l45 25" fill="none" stroke-width="15" /></svg></a>
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