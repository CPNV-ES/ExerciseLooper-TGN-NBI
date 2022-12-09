<main class="container">

    <body>
        <table>
            <thead>
                <tr>
                    <th>Take</th>
                    <?php foreach ($data['fields'] as $field) : ?>
                        <th><a href="/<?= $data['router']->getUrl('fulfillmentResult', ["id" => $data['exerciseId'], "field" => $field->getID()]) ?>"><?= $field->getTitle() ?></a></th>
                    <?php endforeach; ?>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data['fulfillments'] as $fulfillment) : ?>
                    <tr>
                        <td><a href="/<?= $data['router']->getUrl('fulfillmentResults', ["id" => $data['exerciseId'], "fulfillment" => $fulfillment->getID()]) ?>"><?= $fulfillment->getDate() ?> UTC</a></td>
                        <?php foreach ($fulfillment->getFieldsValues() as $response) : ?>
                            <td class="answer">
                                <?php if (strlen($response['value']) == 0) : ?>
                                    <i class="fa fa-times empty"></i>
                                <?php elseif (strlen($response['value']) < 10) : ?>
                                    <i class="fa fa-check short"></i>
                                <?php else : ?>
                                    <i class="fa fa-check-double filled"></i>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</main>