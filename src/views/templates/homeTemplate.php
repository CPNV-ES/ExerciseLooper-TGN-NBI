<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="all" href="/css/style.css" />
    <script src="/js/app.js" defer></script>
    <title><?= $data['title'] ?? "ExerciseLooper" ?></title>
</head>

<body>
    <header class="dashboard">
        <section class="container">
            <p>
                <img src="/images/logo.png">
            </p>
            <h1>Exercise<br>Looper</h1>
        </section>
    </header>
    <?= $content ?>
</body>

</html>