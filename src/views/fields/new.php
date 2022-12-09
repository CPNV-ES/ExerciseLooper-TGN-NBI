<main class="container">
    <div class="row">
        <section class="column">
            <h1>Fields</h1>
            <table class="records">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Value kind</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['fields'] as $field) : ?>
                        <tr>
                            <td><?= $field->getTitle() ?></td>
                            <td><?= $field->getField() ?></td>
                            <td>
                                <a title="Edit fields" href="/<?= $data['router']->getUrl('editField', ["id" => $data['exerciseId'], "field" => $field->getID()]) ?>"><i class="fa fa-edit"></i></a>
                                <form action="/<?= $data['router']->getUrl('deleteField', ["id" => $data['exerciseId'], "field" => $field->getID()]) ?>" method="POST" class="form-hide">
                                    <button type="submit" class="btn-hidden"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form action="/<?= $data['router']->getUrl('updateState', ["id" => $data['exerciseId'], "state" => "Answering"]) ?>" method="POST" class="form-hide">
                <button type="submit" class="button"><i class="fa fa-comment"></i> Complete and be ready for answers</button>
            </form>
        </section>
        <section class="column">
            <h1>New Field</h1>
            <form action="/<?= $data['formNewFieldURL'] ?>" accept-charset="UTF-8" method="post">
                <input type="hidden" name="field[exerciseId]" value="<?= $data['exerciseId'] ?>">
                <div class="field">
                    <label for="title">Label</label>
                    <input type="text" name="field[title]" id="title">
                </div>
                <div class="field">
                    <label for="field_value_kind">Value kind</label>
                    <select name="field[field]" id="field_value_kind">
                        <option selected="selected" value="single_line">Single line text</option>
                        <option value="single_line_list">List of single lines</option>
                        <option value="multi_line">Multi-line text</option>
                    </select>
                </div>
                <input type="submit" value="Create Field">
            </form>
        </section>
    </div>
</main>