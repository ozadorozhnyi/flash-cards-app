<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page 2 * Learning</title>
    </head>
    <body>
        <h2>Page 3 * Answering</h2>
        <form action="<?= $_SERVER['PHP_SELF']?>?action=answering" method="post">
            <div id="card">
                <p id="ua"><?= $nextWord['ua'] ?></p>
                <input type="hidden" name="key" value="<?= $nextWord['ua'] ?>">
                <br>
                <input type="text" name="user_translate" id="" value="">
            </div>
            <br>
            <input type="submit" name="btnNextAnswer" value="Наступне слово!">
        </form>
    </body>
</html>