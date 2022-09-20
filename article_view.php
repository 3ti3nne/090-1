<?php
foreach ($posts as $post) {
    $authors = $conx->request('*', 'user', true, 'id', $post['author']);
    $commentaires = $conx->request('*', 'comment', true, 'post_id', $post['id'], true, 'date_comment');
    $nbCommentMax = count($commentaires);
    $notation ='';
    if ($nbCommentMax <= 1 ){
        $notation =$dictionary['commentaires.page.notation.unique'];
    }else{
        $notation = $dictionary['commentaires.page.notation.multiple'];
    }
    ?>
    <div class="card mx-auto mb-3">
        <div class="card-header">
            <a class="" href="article_author.php?idAuthor=<?= $post['author'] ?>"><?php foreach ($authors as $author) {
                echo $author['lastname'] . ' ' . $author['firstname'];
            } ?></a>
        </div>
        <div class="card-body">
            <h5 class="card-title text"><a href="article_commentaires.php?id=<?= $post['id'] ?>"><?= mb_strtoupper($post['title']) ?></a></h5>
            <p class="card-text"><?= $post['content'] ?></p>
        </div>
        <div class="card-footer card-group justify-content-between text-muted ">
            <div>
                <?= $nbCommentMax . ' ' . $notation?>
            </div>
            <div>
                <?= date('d', time()) - date('d', $post['date_post']) ?> day ago
            </div>
        </div>
    </div>

<?php } ?>