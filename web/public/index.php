<?php

// include '../app/src/Foo.php';
// $foo = new App\Acme\Foo();
// $foo->getName();

require '../app/config/constants.php';
require '../app/config/database.php';

require '../app/src/pdo.php';

$db = new Database();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Kino test app</title>
        <link rel="stylesheet" href="/assets/css/main.css">
    </head>
    <body>
        <?php require 'blocks/no1.php' ?>
        <?php require 'blocks/no2.php' ?>
        <?php require 'blocks/no3.php' ?>
        <?php require 'blocks/no4.php' ?>
        <?php require 'blocks/no5.php' ?>
        <?php require 'blocks/no6.php' ?>
    </body>

    <script type="text/javascript" src="/assets/js/main.js"></script>

</html>
