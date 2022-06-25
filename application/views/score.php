<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page 4 * Scrore</title>
        <link rel="stylesheet" href="<?= BASE_URL.'assets/css/styles.css'?>">
    </head>
    <body>
        <h2>Page 4 * Scrore</h2>
        <ul>
            <?php foreach ($scrore as $item): ?>
                <li>
                    <span class="ua"><?= $item['ua'] ?></span>
                    * <span><?= $item['en']  ?></span> 
                    * <span class="<?= $item['is_correct'] ?>">(<?= $item['user_translated'] ?>)</span>
                </li>
            <?php endforeach ?>
        </ul>
        <p><a href="<?= BASE_URL.'?action=start' ?>">Почтати знову!</a></p>
        <script src="<?= BASE_URL.'/assets/js/app.js' ?></script>
    </body>
</html>