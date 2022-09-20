<?php
require './app/tools/conx.php';
use Panda\connexion\conx;

$dbh = new conx();
$dbh->insertBDD('user',$_POST);

header('Location: index.php');