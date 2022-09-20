<?php
require_once 'dictionary.php';
require_once 'app/tools/conx.php';
use Panda\connexion\conx;
$dbh = new conx();
$tags = $dbh->request('*','tag');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="choices.min.css">
    <title><?= $dictionary['article.page.title'] ?></title>
</head>
<body>
<?php require_once 'header.php' ?>
<main>
    <section class="card w-50 mx-auto">
        <form method="post" action="new_article_$_POST.php">
            <div class="card-header text-center">
                <h1 class="card-title">
                    <?= $dictionary['article.page.title'] ?>
                </h1>
            </div>
            <div class="card-body">
                <input type="hidden" name="blog_id" id="id_blog" value="1">
                <input type="hidden" name="author" id="author" value="2">
                <div class="mb-3">
                    <label for="title"
                           class="form-label">Titre</label>
                    <input type="text" class="form-control" name="title"
                           id="title">
                </div>
                <div class="mb-3">
                    <label for="content"
                           class="form-label">content</label>
                    <textarea type="text" class="form-control" name="content"
                              id="content"></textarea>
                </div>
            </div>
            <div class="card-body">
                <label for="tags">Tags</label>
                <select name="tags[]" id="tags" multiple>
                    <?php
                        foreach ($tags as $tag) {?>
                        <option value="<?= $tag['id'] ?>"><?= $tag['name']?></option>
                    <?php
                        } ?>
                </select>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><?= $dictionary['button.validate'] ?></button>
            </div>
        </form>
    </section>
</main>
<script src="choices.min.js"></script>
<script>
    const tagSelect = document.querySelector('#tags');
    const tagChoice = new Choices(tagSelect,{
        removeItems: true,
        removeItemButton: true,
        placeholder:true,
        placeholderValue: 'insert Tags'
    });
</script>
<?php require_once 'footer.php' ?>
</body>
</html>