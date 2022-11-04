<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="all" href="/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <title><?= $data['title'] ?? "ExerciseLooper" ?></title>
</head>

<body>
    <header class="heading <?= $data['headerColor'] ?? null ?>">
        <section class="container">
            <a href="/"><img src="/images/logo.png"></a>
            <?php if (isset($data['headerTitle']['beforeLink'])): ?>
                <span class="exercise-label"><?= $data['headerTitle']['beforeLink'] ?? null ?> <a href="<?= $data['headerTitle']['link'] ?? null ?>"><?= $data['headerTitle']['afterLink'] ?? null ?></a></span>
            <?php else: ?>
                <span class="exercise-label"><?= $data['headerTitle'] ?? null ?></span>
            <?php endif; ?>
        </section>
    </header>
    <?= $content ?>
</body>

</html>