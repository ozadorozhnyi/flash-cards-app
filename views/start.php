<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page 1 - Hello</title>
    </head>
    <body>
        <h2>Page1 * Start</h2>
        <form action="<?= $_SERVER['PHP_SELF']?>?action=init" method="post">
            <input type="number" name="word_count" value="3" id="" min="1" max="15">
            <br>
            <input type="submit" name="btnStart" value="Розпочати!">
        </form>
    </body>
</html>