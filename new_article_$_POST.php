<?php
require_once './app/tools/conx.php';
require_once 'app/Models/Post.php';
require_once 'app/Models/Post_Tag_mm.php';

use Panda\connexion\conx;
use Panda\post\Post;
use Panda\post\Post_Tag_mm;


$dbh = new conx();
$post = new Post($_POST);

$dbh->insertBDD('post', $post);

$lastID = $dbh->lastID();

foreach ($_POST['tags'] as $item) {
    $bla = ['id_post' => (int)$lastID, 'id_tag' => (int)$item];
    print_r($bla);
    $tagPost = new Post_Tag_mm($bla);
    $dbh->insertBDD('post_tag_mm', $tagPost);
}


//header('Location: index.php');
