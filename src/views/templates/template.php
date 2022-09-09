<!--
    Project: ExerciseLooper - Maw1.1
    Author: Noah Barberini
    Date: 02.09.2022
    Description: Template for the website
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="all" href="/css/style.css" />
    <title><?= $data['title'] ?? "ExerciseLooper" ?></title>
</head>
<body>
    <header class="heading <?= $data['headerColor'] ?? null ?>">
        <section class="container">
            <a href="/"><img src="/images/logo.png"></a>
            <span class="exercise-label"><?= $data['headerTitle'] ?? null ?></span>
        </section>
    </header>
    <?= $content ?>
</body>
</html>