<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page 2 * Learning</title>
    </head>
    <body>
        <h2>Page 2 * Learning</h2>
        <form action="<?= $_SERVER['PHP_SELF']?>?action=learning" method="post">
            <div id="card">
                <p id="en"><?= $nextWord['en'] ?></p>
                <p id="ua"><?= $nextWord['ua'] ?></p>
            </div>
            <br>
            <input type="submit" name="btnNextCard" value="Наступне слово!">
        </form>
    </body>
</html>