<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page 4 * Scrore</title>
        <style>
            .ua {
                color:blueviolet;
            }
            .correct {
                color:green;
            }
            .incorrect {
                color:red;
            }
        </style>
    </head>
    <body>
        <h2>Page 4 * Scrore</h2>
        <ul>
            <?php foreach ($scrore as $item): ?>
                <li>
                    <span class="ua"><?= $item['ua']?></span>
                    * <span class="<?= $item['is_correct'] ?>"><?= $item['user_translated'] ?> (<?=  $item['en']  ?>)</span>
                </li>
            <?php endforeach ?>
        </ul>
    </body>
</html>