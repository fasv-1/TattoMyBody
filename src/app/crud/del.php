<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: signin.php');
    exit;
} else {
    require_once('../functions.php');
    $section = !empty($_GET['s']) ? $_GET['s'] : null;
    $token = !empty($_GET['token']) ? $_GET['token'] : null;
    $table = !empty($_GET['t']) ? $_GET['t'] : null;
    $image = !empty($_GET['i']) ? $_GET['i'] : null;
    

    $Path = "../tattooers/images/$token";
    $newsPath = "../tattooers/news_images/$image";
    if (file_exists($Path) | file_exists($newsPath)) {
        if (unlink($Path)) {
            echo "success";
        } elseif(unlink($newsPath)) {
            echo "success";
        }
    } else {
        echo "file does not exist";
        exit;
    }


    $sql = "DELETE FROM $table WHERE token_$section = ?";
    $stmt = conn()->prepare($sql);
    if ($stmt->execute([$token])) {
        $n = $stmt->rowCount();
        if ($n === 1) {
            $i = $stmt->fetch();
            $q = $i['token_image'];
            $stmt = null;
            header("Location: ../tattooers/portfolio.php");
            exit;
        }
    }
}
