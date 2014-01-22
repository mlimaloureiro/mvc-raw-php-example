<div class="row-fluid">

  <div class="span12">
    <form method="POST" action="admin.php?do=adicionarCategoria">
    <fieldset>
        <legend>Nova categoria</legend>
        <input type="text" name="nome" placeholder="Nome">
        <br />
        <button type="submit" class="btn">Submeter</button>
      </fieldset>
    </form>
  </div>
</div>
<div class="row-fluid">

  <div class="span12">
    <form method="POST" action="admin.php?do=adicionarLivro">
    <fieldset>
        <legend>Adicionar Livro</legend>
        <input type="text" name="nome" placeholder="Nome"><br />
        <input type="text" name="autor" placeholder="Autor"><br />
        <input type="text" name="edicao" placeholder="Edicão"><br />
        <input type="text" name="ano" placeholder="Ano"><br />
        <select name="categoria">
          <?php foreach($categorias as $c) { 
                  if(is_object($c)) 
                    echo "<option value='$c->ID_Categoria'>".$c->Nome."</option>";
                  
                } ?>
        </select>
        <br />
        <button type="submit" class="btn">Submeter</button>
      </fieldset>
    </form>
  </div>

</div>


<div class="row-fluid">
  <div class="span12">
    <h4>Livros</h4>

    <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Livro</th>
            <th>Autor</th>
            <th>Categoria</th>
            <th>Disponível em</th>
            <?php 


                /* SE EXISTE SESSAO INICIADA PERMITIR OPERACOES */

              if(isset($_SESSION['ID_Utilizador'])) {?><th>Operações</th><?php }?>
          </tr>
        </thead>
        <tbody>
          <?php foreach($livros as $l) { if(is_object($l)) { ?>
            <tr>
              <th><?=$l->ID_Livro?></th>
              <th><?=$l->nome?></th>
              <th><?=$l->autor?></th>
              <th><?=pesquisaCategoriaLivro($l->ID_Livro)?>
              <th><?php 
                      if(calcDisponibilidade($l->ID_Livro))
                        echo date('d-m-Y',calcDisponibilidade($l->ID_Livro)); 
                  ?>
              </th>
              <th><?php if(isset($_SESSION['ID_Utilizador'])) {?> <a href="admin.php?do=removerLivro&livro=<?=$l->ID_Livro?>"<button class="btn btn-primary"> Eliminar </button></a><?php } ?> </th>
            </tr>
          <?php } } ?>
        </tbody>
    </table>

  </div>
</div>