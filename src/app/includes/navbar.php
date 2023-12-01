<nav id="navbar">
  <div class="nav-items">

    <div class="toggle">
      <div class="minilogo"><a href="/app/index.php">TMB</a></div>
      <svg class="hambuguer" width="24px" height="24px" viewBox="0 0 24 24" style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 1.41421;">
        <rect class="top" x="4" y="6" width="18" height="2"></rect>
        <rect class="middle" x="4" y="11" width="18" height="2"></rect>
        <rect class="bottom" x="4" y="16" width="18" height="2"></rect>
      </svg>

    </div>
    <ul>
      <li><a href="/app/tatuadores.php">TATUADORES</a></li>
      <li><a href="/app/tatuagens.php">TATUAGENS</a></li>
      <li><a href="/app/interesses.php">INTERESSES</a></li>
    </ul>
  </div>
  <div class="users"><a href="
    <?php
    if ($_SESSION && $_SESSION['level'] >= 2) { ?>
        /app/tattooers/portfolio.php
        <?php } else { ?> 
        /app/crud/userpage.php
        <?php } ?>">
        <?php 
        if ($_SESSION) {
          $tokens = $_SESSION ['token'];
          if (file_exists("".$_SERVER['DOCUMENT_ROOT']."/app/users/$tokens/$tokens.jpg")) {
            echo "<div class='avatar'><img class='avatar' src='http://".$_SERVER['HTTP_HOST']."/app/users/$tokens/$tokens.jpg?v=".date('U')."' ></div>";
          } else {
            echo '<i class="far fa-user fa-2x"></i>';
          }
        }?>
      </a>
    <?php
      if ($_SESSION){
        echo "<div class='exit'><a href='http://".$_SERVER['HTTP_HOST']."/app/signout.php'>Signout</a></div>";
      }
    ?>
    </div>
</nav>