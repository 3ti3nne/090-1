<?php require_once 'dictionary.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title><?= $dictionary['register.page.title'] ?></title>
</head>
<body>
<?php require_once 'header.php' ?>
<main>
    <section class="card w-50 mx-auto">
        <form method="post" action="new_user_$_POST.php">
            <div class="card-header text-center">
                <h1 class="card-title">
                    <?= $dictionary['register.page.title'] ?>
                </h1>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="<?= $dictionary['register.page.form.email'] ?>"
                           class="form-label"><?= $dictionary['register.page.form.email'] ?></label>
                    <input type="email" class="form-control" name="<?= $dictionary['register.page.form.email'] ?>" id="<?= $dictionary['register.page.form.email'] ?>"
                           aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="<?= $dictionary['register.page.form.firstname'] ?>"
                           class="form-label"><?= $dictionary['register.page.form.firstname'] ?></label>
                    <input type="text" class="form-control" name="<?= $dictionary['register.page.form.firstname'] ?>"
                           id="<?= $dictionary['register.page.form.firstname'] ?>">
                </div>
                <div class="mb-3">
                    <label for="<?= $dictionary['register.page.form.lastname'] ?>"
                           class="form-label"><?= $dictionary['register.page.form.lastname'] ?></label>
                    <input type="text" class="form-control" name="<?= $dictionary['register.page.form.lastname'] ?>"
                           id="<?= $dictionary['register.page.form.lastname'] ?>">
                </div>
                <select class="form-select" aria-label="Default select example" name="role">
                    <option selected>Open this select menu</option>
                    <option value="Administrator">Administrator</option>
                    <option value="Blogger">Blogger</option>
                    <option value="Commentator">Commentator</option>
                </select>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><?= $dictionary['button.validate'] ?></button>
            </div>
        </form>
    </section>
</main>
<?php require_once 'footer.php' ?>
</body>
</html>