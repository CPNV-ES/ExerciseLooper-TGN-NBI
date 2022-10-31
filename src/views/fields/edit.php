<main class="container">
    <h1>Editing Field</h1>

    <form action="/<?= $data['router']->getUrl('editFieldPost', ["id" => $data['exerciseId'], "field" => $data['field']->getID()])?>" accept-charset="UTF-8" method="post">
        <input name="utf8" type="hidden" value="✓">
        <div class="field">
            <label for="field_title">Label</label>
            <input type="text" value="<?= $data['field']->getTitle() ?>" name="field[title]" id="field_title">
        </div>

        <div class="field">
            <label for="field_value_kind">Value kind</label>
            <select name="field[value_kind]" id="field_value_kind" autocomplete="off">
                <option <?= $data['field']->getField() == 'single_line' ? 'selected="selected"' : '' ?> value="single_line">Single line text</option>
                <option <?= $data['field']->getField() == 'single_line_list' ? 'selected="selected"' : '' ?> value="single_line_list">List of single lines</option>
                <option <?= $data['field']->getField() == 'multi_line' ? 'selected="selected"' : '' ?> value="multi_line">Multi-line text</option>
            </select>
        </div>

        <div class="actions">
            <input type="submit" name="commit" value="Update Field" data-disable-with="Update Field">
        </div>
    </form>
</main>