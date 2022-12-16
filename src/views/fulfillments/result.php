<main class="container">

    <body>
        <h1><?= $data['field']->getTitle() ?></h1>
        <table>
            <thead>
                <tr>
                    <th>Take</th>
                    <th>Content</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['fulfillments'] as $fulfillment) : ?>
                    <tr>
                        <td><a href="/<?= $data['router']->getUrl('fulfillmentResults', ["id" => $data['exerciseId'], "fulfillment" => $fulfillment->getID()]) ?>"><?= $fulfillment->getDate() ?> UTC</a></td>
                        <?php foreach ($fulfillment->getFieldsValues() as $response) : ?>
                            <?php if ($response['field']->getID() == $data['field']->getID()) : ?>
                                <td>
                                    <?= $response['value'] ?>
                                </td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</main>