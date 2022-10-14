<main class="container">
    <div class="row">
        <section class="column">
            <h1>Building</h1>
            <table class="records">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['exercisesBuilding'] as $exBuilding) : ?>
                        <tr>
                            <td><?= $exBuilding->getTitle() ?></td>
                            <td>
                                <?php if (!empty($exBuilding->getFields())): ?>
                                    <form action="<?= $data['router']->getUrl('updateState', ["id" => $exBuilding->getID(), "state" => "Answering"])?>" method="POST" class="form-hide">
                                    <button type="submit" class="btn-hidden"><i class="fa fa-comment"></i></button>
                                </form>
                                <?php endif; ?>
                                <a title="Manage fields" href="<?= $data['router']->getUrl('newField', ["id" => $exBuilding->getID()]) ?>"><i class="fa fa-edit"></i></a>
                                <form action="<?= $data['router']->getUrl('deleteExercise', ["id" => $exBuilding->getID()])?>" method="POST" class="form-hide">
                                    <button type="submit" class="btn-hidden"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section class="column">
            <h1>Answering</h1>
            <table class="records">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data['exercisesAnswering'] as $exAnswer) : ?>
                        <tr>
                            <td><?= $exAnswer->getTitle() ?></td>
                            <td>
                                <form action="<?= $data['router']->getUrl('results', ["id" => $exAnswer->getID()])?>" method="POST" class="form-hide">
                                    <button type="submit" class="btn-hidden"><i class="fa fa-chart-bar"></i></button>
                                </form>
                                <form action="<?= $data['router']->getUrl('updateState', ["id" => $exAnswer->getID(), "state" => "Closed"])?>" method="POST" class="form-hide">
                                    <button type="submit" class="btn-hidden"><i class="fa fa-minus-circle"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section class="column">
            <h1>Closed</h1>
            <table class="records">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data['exercisesClosed'] as $exClosed) : ?>
                        <tr>
                            <td><?= $exClosed->getTitle() ?></td>
                            <td>
                                <a title="Show results" href="/exercises/<?= $exClosed->getID() ?>/results"><i class="fa fa-chart-bar"></i></a>
                                <form action="<?= $data['router']->getUrl('deleteExercise', ["id" => $exClosed->getID()])?>" method="POST" class="form-hide">
                                    <button type="submit" class="btn-hidden"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</main>