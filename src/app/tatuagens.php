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
-----------------------------Fim do Header-----------------------------
************************************************************************** -->
  <!-- **************************************************************************
-----------------------------Inicio do Main-----------------------------
************************************************************************** -->

  <main class="tatuagens">

    <!------------------------- Dropdown menu ----------------------------- -->

    <div id="tattoosmenu">
      <h4>Aqui podes encontrar e procurar alguns dos melhores exemplos de estilos de tatuagens</h4>
      <div class="dropdown">
        <button class="dropbtn">Escolhe o teu estilo de tatuagem</button>
        <div id="dropdownTattoo" class="dropdown-content">
          <a class="blackgreyi" href="#blacke">Black & Grey</a>
          <a class="dotworki" href="#dotworke">Dotwork</a>
          <a class="japanesei" href="#japanesee">Japanese</a>
          <a class="tribali" href="#tribale">Tribal</a>
          <a class="neoi" href="#neoe">Neo-Tradicional</a>
          <a class="realismoi" href="#realismoe">Realismo</a>
          <a class="spacei" href="#spacee">Space</a>
          <a class="surrealismoi" href="#surrealismoe">Surrealismo</a>
          <a class="tradicionali" href="#tradicionale">Tradicional</a>
          <a class="trashpolkai" href="#trashe">Trash-Polka</a>
        </div>
      </div>
    </div>

  <!-- *********************************************************************************************
  ----------------------- container para os varios estilos de tatuagem ----------------------------- 
  ************************************************************************************************** -->
    

    <div id="tattoosplace">
<!------------------------------- Vários ------------------------------->
      <div class="tattoos">
        <h1>Estilos variados</h1>
        <?php
        $qw = 'random';
        $data = image($qw);

        foreach ($data as $i) {
          $image = $i['token_image'];
        ?>
          <div class="imgcont">
            <?php echo "<a href='singletattoo.php?token=$image'><img src='tattooers/images/$image'></a>"; ?>
          </div>
        <?php
        } ?>
      </div>
<!------------------------------- Black&Grey ------------------------------->
      <div class="tattoos">
        <h1>Black & Grey</h1>
        <?php
        $qw = 'black&grey';
        $data = image($qw);

        foreach ($data as $i) {
          $image = $i['token_image'];
        ?>
          <div id="blacke">
            <?php echo "<a href='singletattoo.php?token=$image'><img src='tattooers/images/$image'></a>"; ?>
          </div>
        <?php
        } ?>
      </div>
<!------------------------------- Dotwork ------------------------------->
      <div class="tattoos">
        <h1>Dotwork</h1>
        <?php
        $qw = 'dotwork';
        $data = image($qw);

        foreach ($data as $i) {
          $image = $i['token_image'];
        ?>
          <div id="dotworke">
            <?php echo "<a href='singletattoo.php?token=$image'><img src='tattooers/images/$image'></a>"; ?>
          </div>
        <?php
        } ?>
      </div>
<!------------------------------- Japanese ------------------------------->
      <div class="tattoos">
        <h1>Japanese</h1>
        <?php
        $qw = 'japanese';
        $data = image($qw);

        foreach ($data as $i) {
          $image = $i['token_image'];
        ?>
          <div id="japanesee">
            <?php echo "<a href='singletattoo.php?token=$image'><img src='tattooers/images/$image'></a>"; ?>
          </div>
        <?php
        } ?>
      </div>
<!------------------------------- Tribal ------------------------------->
      <div class="tattoos">
        <h1>Tribal</h1>
        <?php
        $qw = 'tribal';
        $data = image($qw);

        foreach ($data as $i) {
          $image = $i['token_image'];
        ?>
          <div id="tribale">
            <?php echo "<a href='singletattoo.php?token=$image'><img src='tattooers/images/$image'></a>"; ?>
          </div>
        <?php
        } ?>
      </div>
<!------------------------------- Neo-Tradicional ------------------------------->
      <div class="tattoos">
        <h1>Neo-tradicional</h1>
        <?php
        $qw = 'neotradicional';
        $data = image($qw);

        foreach ($data as $i) {
          $image = $i['token_image'];
        ?>
          <div id="neoe">
            <?php echo "<a href='singletattoo.php?token=$image'><img src='tattooers/images/$image'></a>"; ?>
          </div>
        <?php
        } ?>
      </div>
<!------------------------------- Realismo ------------------------------->
      <div class="tattoos">
        <h1>Realismo</h1>
        <?php
        $qw = 'realismo';
        $data = image($qw);

        foreach ($data as $i) {
          $image = $i['token_image'];
        ?>
          <div id="realismoe">
            <?php echo "<a href='singletattoo.php?token=$image'><img src='tattooers/images/$image'></a>"; ?>
          </div>
        <?php
        } ?>
      </div>
<!------------------------------- Space ------------------------------->
      <div class="tattoos">
        <h1>Space</h1>
        <?php
        $qw = 'space';
        $data = image($qw);

        foreach ($data as $i) {
          $image = $i['token_image'];
        ?>
          <div id="spacee">
            <?php echo "<a href='singletattoo.php?token=$image'><img src='tattooers/images/$image'></a>"; ?>
          </div>
        <?php
        } ?>
      </div>
<!------------------------------- Surrealismo ------------------------------->
      <div class="tattoos">
        <h1>Surrealismo</h1>
        <?php
        $qw = 'surrealismo';
        $data = image($qw);

        foreach ($data as $i) {
          $image = $i['token_image'];
        ?>
          <div id="surrealismoe">
            <?php echo "<a href='singletattoo.php?token=$image'><img src='tattooers/images/$image'></a>"; ?>
          </div>
        <?php
        } ?>
      </div>
<!------------------------------- Tradicional ------------------------------->
      <div class="tattoos">
        <h1>Tradicional</h1>
        <?php
        $qw = 'tradicional';
        $data = image($qw);

        foreach ($data as $i) {
          $image = $i['token_image'];
        ?>
          <div id="tradicionale">
            <?php echo "<a href='singletattoo.php?token=$image'><img src='tattooers/images/$image'></a>"; ?>
          </div>
        <?php
        } ?>
      </div>
<!------------------------------- Trash-Polka ------------------------------->
      <div class="tattoos">
        <h1>Trash-Polka</h1>
        <?php
        $qw = 'trashpolka';
        $data = image($qw);

        foreach ($data as $i) {
          $image = $i['token_image'];
        ?>
          <div id="trashe">
            <?php echo "<a href='singletattoo.php?token=$image'><img src='tattooers/images/$image'></a>"; ?>
          </div>
        <?php
        } ?>
      </div>
    </div>

    <a class="up" href="./tatuagens.php#logoBar"><svg class="chevron" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 35" width="25">
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