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
    <title><?= $dictionary['commentaires.page.title'] ?></title>
</head>
<?php require_once 'header.php' ?>
<body>
<?php
$posts = $conx->request('*', 'post', true, 'id', $value , true, 'date_post');
include_once 'article_view.php' ?>
<section class="card w-50 mx-auto">
    <form method="post" action="new_comment_$_POST.php">

        <div class="card-body">
            <input type="hidden" name="post_id" id="post_id" value="<?= $value ?>">
            <input type="hidden" name="date_comment" id="date_comment" value="<?= time() ?>">
            <div class="mb-3">
                <label for="content"
                       class="form-label"><?=  $dictionary['commentaires.page.form'] ?></label>
                <textarea type="text" class="form-control" name="content"
                          id="content"></textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><?= $dictionary['button.validate'] ?></button>
        </div>
    </form>
</section>
<?php
$nbComment = $nbCommentMax;
foreach ($commentaires as $comment) { ?>
    <div class="card mx-auto mb-3">
        <div class="card-body">
            <p class="card-text"><?= $comment['content'] ?></p>
        </div>
        <div class="card-footer card-group justify-content-between text-muted ">
            <div>
                <?= $dictionary['commentaires.page.notation.unique'] . ' ' . $nbComment . '/' . $nbCommentMax ?>
            </div>
            <div>
                <?= date('d/m/Y', $comment['date_comment']) ?>
            </div>
        </div>
    </div>
    <?php --$nbComment;
} ?>
</body>
<?php require_once 'footer.php' ?>
</html>