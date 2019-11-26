<?php
    session_start();

    require_once "../Src/Config/Config.php";
    require_once "../Src/vendor/autoload.php";
    $rota = new Src\Core\Init();

    #$rota = new Src\Core\ProcessaRota();

    #var_dump($rota->getUrl());
?>

