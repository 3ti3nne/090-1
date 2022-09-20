<?php
require_once './app/tools/conx.php';
use Panda\connexion\conx;

$dbh = new conx();
$dbh->insertBDD('comment', $_POST);

header('Location: article_commentaires.php?idArticle='. $_POST['post_id']);
