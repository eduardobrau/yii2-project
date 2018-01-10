
<div class="jumbotron">
  <form class="form-inline center-block" action="/anuncios/pesquisar" method="get">
    <select name="tag_id" id="selectTag" class="form-control select-tag">
      <option value="">O que procura?</option>
      <?php 
        foreach ($tags as $tag) {
          echo "<option value=\"{$tag->id}\"> {$tag->tag} </option>";
        }
      ?>
    </select>
    <select name="categoria_id" id="selectCategory" class="form-control">
      <option value="">Em qual categoria?</option>
      <?php 
        foreach ($categorias as $categoria) {
          echo "<option value=\"{$categoria->id}\"> {$categoria->categoria} </option>";
        }
      ?>
    </select>
    <select
      name="cidade_id"
      id="selectCity" 
      class="form-control" 
      data-drop-change="selectBairro"
      data-action-url="/bairros/listar-bairros">
      <option value="">Em qual Cidade?</option>
      <?php
        foreach($cidades as $cidade) {
          echo "<option value=\"{$cidade->id}\"> {$cidade->cidade} </option>";
        }
      ?>
    </select>
    <select name="bairro_id" id="selectBairro" class="form-control selectBairro">
        <option value="">Em qual Bairro?</option>
    </select>

      <button type="submit" class="btn btn-primary">Pesquisar</button>
  </form>
</div>