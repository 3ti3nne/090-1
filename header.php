<?php
$key = key($_GET);
$value = reset($_GET);
$searching = (isset($_GET["search"]) and !empty($_GET["search"]));
if ($searching) {
    $search = $conx->search();
    $search->execute(array( $_GET['search'] ));
    $results = array();
    while ($result = $search->fetch()) {
        $results[] = $result;
    }
    $search->closeCursor();
}

?>
<header>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><?= $dictionary['index.page.title'] ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                           href="new_user.php"><?= $dictionary['register.page.title'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                           href="new_article.php"><?= $dictionary['article.page.title'] ?></a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="visually-hidden" type="search" name="<?= $key ?>" value="<?= $value ?>">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                           name="search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <?php
    if ($searching) {
        ?>
        <div class="found">
            <?php
            if (count($results) > 0) {
                foreach ($results as $result) {
                    ?>
                    <p class="found_p">
                        <a class="text-decoration-none"
                           href="article_commentaires.php?idArticle=<?= $result['id'] ?>">"<?= htmlspecialchars($result['title']) ?>
                            "</a>
                        de
                        <a class="text-decoration-none"
                           href="article_author.php?idAuthor=<?= $result['author'] ?>">  <?= htmlspecialchars($result['lastname'] . ' ' . $result['firstname']) ?></a>
                    </p>
                    <?php
                }
            } else {
                ?>
                <p class="not_found_p"> aucun résultat pour la recherche : "<?= htmlspecialchars($_GET['search']) ?>
                    "</p>
            <?php } ?>
        </div>
    <?php } ?>
</header>