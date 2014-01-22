<div class="row-fluid">
  <div class="span12">
    <h4>Reservar</h4>

    <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Livro</th>
            <th>Autor</th>
            <th>Categoria</th>
            <th>Disponível em</th>
            <?php if(isset($_SESSION['ID_Utilizador'])) {?><th>Operações</th><?php }?>
          </tr>
        </thead>
        <tbody>
          <?php foreach($livros as $l) { if(is_object($l)) { ?>
            <tr>
              <th><?=$l->ID_Livro?></th>
              <th><?=$l->nome?></th>
              <th><?=$l->autor?></th>
              <th><?=pesquisaCategoriaLivro($l->ID_Livro)?></th>
              <th><?php 
                      if(calcDisponibilidade($l->ID_Livro))
                        echo date('d-m-Y',calcDisponibilidade($l->ID_Livro)); 
                  ?>
                </th>
              <th><?php if(isset($_SESSION['ID_Utilizador'])) {?> <a href="index.php?do=reservar&livro=<?=$l->ID_Livro?>"<button class="btn btn-primary"> Requisitar </button></a><?php } ?> </th>
            </tr>
          <?php } } ?>
        </tbody>
    </table>

  </div>
</div>