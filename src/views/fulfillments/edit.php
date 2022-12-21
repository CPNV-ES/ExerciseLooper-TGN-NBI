<main class="container">
    <h1>Your take</h1>
    <p>Bookmark this page, it's yours. You'll be able to come back later to finish.</p>
    <form action="/<?= $data['formEditFulfillmentURL'] ?>" accept-charset="UTF-8" method="post">
        <?php foreach ($data['values'] as $value) : ?>
            <input type="hidden" value="<?= $value['field']->getId() ?>" name="fulfillment[answers_attributes][][field_id]" id="fulfillment_answers_attributes__field_id" />
            <?php if ($value['field']->getField() == "single_line") : ?>
                <label for="field-<?= $value['field']->getId() ?>"><?= $value['field']->getTitle() ?></label>
                <input id="field-<?= $value['field']->getId() ?>" type="text" value="<?= $value['value'] ?>" name="fulfillment[answers_attributes][][value]" />
            <?php elseif ($value['field']->getField() == "single_line_list") : ?>
                <label for="field-<?= $value['field']->getId() ?>"><?= $value['field']->getTitle() ?></label>
                <textarea id="field-<?= $value['field']->getId() ?>" type="text" name="fulfillment[answers_attributes][][value]"><?= $value['value'] ?></textarea>
            <?php elseif ($value['field']->getField() == "multi_line") : ?>
                <label for="field-<?= $value['field']->getId() ?>"><?= $value['field']->getTitle() ?></label>
                <input id="field-<?= $value['field']->getId() ?>" type="text" value="<?= $value['value'] ?>" name="fulfillment[answers_attributes][][value]" />
            <?php endif; ?>
        <?php endforeach; ?>
        <div class="actions">
            <input type="submit" name="commit" value="Save" data-disable-with="Save" />
        </div>
    </form>
</main>