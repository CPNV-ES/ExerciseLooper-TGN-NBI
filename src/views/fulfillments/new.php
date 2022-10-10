<main class="container">
    <h1>Your take</h1>
    <p>If you'd like to come back later to finish, simply submit it with blanks</p>

    <form action="/<?= $data['formNewFulfillmentURL'] ?>" accept-charset="UTF-8" method="post">
        <?php foreach ($data['exercise']->getFields() as $field): ?>
            <input type="hidden" value="<?= $field->getId() ?>" name="fulfillment[answers_attributes][][field_id]" id="fulfillment_answers_attributes__field_id" />
            <?php if ($field->getField() == "single_line"): ?>
                <label for="field-<?= $field->getId() ?>"><?= $field->getTitle()?></label>
                <input id="field-<?= $field->getId() ?>" type="text" name="fulfillment[answers_attributes][][value]"/>
            <?php elseif ($field->getField() == "single_line_list"): ?>
                <label for="field-<?= $field->getId() ?>"><?= $field->getTitle()?></label>
                <textarea id="field-<?= $field->getId() ?>" type="text" name="fulfillment[answers_attributes][][value]"></textarea>
            <?php elseif ($field->getField() == "multi_line"): ?>
                <label for="field-<?= $field->getId() ?>"><?= $field->getTitle()?></label>
                <input id="field-<?= $field->getId() ?>" type="text" name="fulfillment[answers_attributes][][value]"/>
            <?php endif; ?>
        <?php endforeach; ?>
        <div class="actions">
            <input type="submit" name="commit" value="Save" data-disable-with="Save" />
        </div>
    </form>
</main>