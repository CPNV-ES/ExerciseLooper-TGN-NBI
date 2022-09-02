<header>
  <section class="container">
    <a href="/"><img src="/assets/logo-84d7d70645fbe179ce04c983a5fae1e6cba523d7cd28e0cd49a04707ccbef56e.png"></a>
  </section>
</header>
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
        </tbody>
      </table>
      <a data-confirm="Are you sure? You won&#39;t be able to further edit this exercise" class="button" rel="nofollow" data-method="put" href="/exercises/715?exercise%5Bstatus%5D=answering"><i class="fa fa-comment"></i> Complete and be ready for answers</a>
    </section>
    <section class="column">
      <h1>New Field</h1>
        <form action="/exercises/715/fields" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="YXdP1JsUrmM1jm6X7YGHg2gjbIx4SLztNy9/44iPoY3dOL3S4Vi/B/GW9qC+3AivrJn401vTbSzvZqaoObhoKQ==" />
          <div class="field">
            <label for="field_label">Label</label>
            <input type="text" name="field[label]" id="field_label" />
          </div>
          <div class="field">
            <label for="field_value_kind">Value kind</label>
            <select name="field[value_kind]" id="field_value_kind"><option selected="selected" value="single_line">Single line text</option>
              <option value="single_line_list">List of single lines</option>
              <option value="multi_line">Multi-line text</option>
            </select>
          </div>
          <div class="actions">
            <input type="submit" name="commit" value="Create Field" data-disable-with="Create Field" />
          </div>
        </form>
    </section>
  </div>
</main>