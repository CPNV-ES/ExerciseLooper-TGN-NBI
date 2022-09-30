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
                    <?php foreach ($data['exercisesBuilding'] as $exBuild) : ?>
                        <tr>
                            <td><?= $exBuild->getTitle() ?></td>
                            <td>
                                <a title="Be ready for answers" rel="nofollow" data-method="put" href="/exercises/<?= $exBuild->getID() ?>?exercise%5Bstatus%5D=answering"><i class="fa fa-comment"></i></a>
                                <a title="Manage fields" href="/exercises/<?= $exBuild->getID() ?>/fields"><i class="fa fa-edit"></i></a>
                                <a data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete" href="/exercises/<?= $exBuild->getID() ?>"><i class="fa fa-trash"></i></a>
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
                                <a title="Show results" href="/exercises/<?= $exAnswer->getID() ?>/results"><i class="fa fa-chart-bar"></i></a>
                                <a title="Close" rel="nofollow" data-method="put" href="/exercises/<?= $exAnswer->getID() ?>?exercise%5Bstatus%5D=closed"><i class="fa fa-minus-circle"></i></a>
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
                                <a data-confirm="Are you sure?" title="Destroy" rel="nofollow" data-method="delete" href="/exercises/<?= $exClosed->getID() ?>"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</main>