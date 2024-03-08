<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $titre ?>
    </title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>

    <img class="waves top_waves" src="./public/img/topWaves.svg" alt="">
    <main>
        <h2>
            <?= $titre_secondaire ?>
        </h2>
        <?= $content ?>
    </main>
    <img class="waves top_waves" src="./public/img/bottomWaves.svg" alt="">

</body>

</html>