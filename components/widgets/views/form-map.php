
<div class="jumbotron">
  <form class="form-inline center-block">
    <select id="selectTag" class="form-control select-tag">
      <option>O que procura?</option>
      <?php 
        foreach ($tags as $tag) {
          echo "<option value=\"{$tag->id}\"> {$tag->tag} </option>";
        }
      ?>
    </select>
    <select id="selectCategory" class="form-control">
      <option>Em qual categoria?</option>
      <?php 
        foreach ($categorias as $categoria) {
          echo "<option value=\"{$categoria->id}\"> {$categoria->categoria} </option>";
        }
      ?>
    </select>
    <select 
      id="selectCity" 
      class="form-control" 
      data-drop-change="selectBairro"
      data-action-url="/bairros/listar-bairros">
      <option>Em qual Cidade?</option>
      <?php
        foreach($cidades as $cidade) {
          echo "<option value=\"{$cidade->id}\"> {$cidade->cidade} </option>";
        }
      ?>
    </select>
    <select id="selectBairro" class="form-control selectBairro">
        <option>Em qual Bairro?</option>
    </select>

      <button type="submit" class="btn btn-success">Pesquisar</button>
  </form>
</div>