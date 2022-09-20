<?php
require_once 'dictionary.php';
require_once './app/tools/conx.php';

use Panda\connexion\conx;

$conx = new conx();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title><?= $dictionary['author.page.title'] ?></title>
</head>
<?php require_once 'header.php' ?>
<body>
<?php
$posts = $conx->request('*', 'post', true, 'author', $_GET['idAuthor'], true, 'date_post');
include_once 'article_view.php';
?>
</body>
<?php require_once 'footer.php'
?>
</html>