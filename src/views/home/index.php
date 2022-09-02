
<header class="dashboard">
    <section class="container">
        <h1>Exercise<br>Looper</h1>
    </section>
</header>
<div class="container dashboard">
    <section class="row">
        <div class="column">
            <a class="button answering column" href="/exercises/answering">Take an exercise</a>
        </div>
        <div class="column">
            <a class="button managing column" href="/exercises/new">Create an exercise</a>
        </div>
        <div class="column">
            <a class="button results column" href="/exercises">Manage an exercise</a>
        </div>
    </section>
    <?php foreach($data['exercises'] as $ex):?>
        <p>foo <?= $ex ?></p>
    <?php endforeach;?>
</div>