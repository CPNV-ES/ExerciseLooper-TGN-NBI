<main class="container">
    <title>ExerciseLooper</title>
    <meta name="csrf-param" content="authenticity_token">
    <meta name="csrf-token" content="o9ZxgfZHIDvMZ82JUMo0+MAolemVIOjB4HzbMHiCPnlPD04xJCAI8yWuC0udtKF7mlDp5s8bf6d/CNjKRD6SRg==">
    <link rel="stylesheet" media="all" href="/assets/application-264507a893987846393b8514969b89293817c54265354e63e6ab61fb46193f89.css">
    <script src="/assets/application-212289bcba525f2374cdbd70755ea38f2cfdd35d479e9638fae0b2832fac5dac.js"></script>
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
                </tbody>
            </table>
            <a data-confirm="Are you sure? You won't be able to further edit this exercise" class="button" rel="nofollow" data-method="put" href="/exercises/778?exercise%5Bstatus%5D=answering"><i class="fa fa-comment"></i> Complete and be ready for answers</a>
        </section>
        <section class="column">
            <h1>New Field</h1>
            <form action="/exercises/778/fields" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="✓"><input type="hidden" name="authenticity_token" value="o9ZxgfZHIDvMZ82JUMo0+MAolemVIOjB4HzbMHiCPnlPD04xJCAI8yWuC0udtKF7mlDp5s8bf6d/CNjKRD6SRg==">
                <div class="field">
                    <label for="field_label">Label</label>
                    <input type="text" name="field[label]" id="field_label">
                </div>
                <div class="field">
                    <label for="field_value_kind">Value kind</label>
                    <select name="field[value_kind]" id="field_value_kind">
                        <option selected="selected" value="single_line">Single line text</option>
                        <option value="single_line_list">List of single lines</option>
                        <option value="multi_line">Multi-line text</option>
                    </select>
                </div>
                <div class="actions">
                    <input type="submit" name="commit" value="Create Field" data-disable-with="Create Field">
                </div>
            </form>
        </section>
    </div>
</main>