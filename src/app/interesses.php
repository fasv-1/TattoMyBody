<?php
    session_start();
    require_once('includes/head.php');?>

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
<!-----------------------------Fim do Header-----------------------------
************************************************************************** -->
  <main>

    <!-------------------------Inicio da pagina interesses----------------------------- -->

    <div id="interesses">
      <div class="pontos-dificeis">
        <div class="descricao">
          <h1>Interesses</h1>
          <p>Aqui podes encontrar algumas curiosidades e notícias do mundo da tatuagem.</p>
        </div>
        <div class="dor">
          <h2>Achas que tens coragem para fazer uma tatuagem?</h2>
          <img src="images/ondedoimais.jpg" alt="dor">
        </div>
      </div>

      <!-------------- Aqui é gerado as noticias dinamicamente através de uma api--------------- -->

      <div id="noticias">
        <h1><span>Notícias</span></h1>
      </div>
    </div>

    <!-------------------------butão para voltar para cima----------------------------- -->

    <a class="up" href="./interesses.php#logoBar"><svg class="chevron" xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 100 35" width="25">
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