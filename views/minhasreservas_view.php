<div class="row-fluid">
  <div class="span12">
    <h4>Minhas Reservas</h4>

    <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Livro</th>
            <th>Data Levantamento</th>
            <th>Data Entrega</th>
            <th>Operações</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(isset($reservas)){
            foreach($reservas as $l) { if(is_object($l)) { ?>
            <tr>
              <th><?=$l->ID_Livro?></th>
              <th><?=$l->nome?></th>
              <th><?=date('d-m-Y',$l->datalevantamento)?></th>
              <th><?=date('d-m-Y',$l->dataentrega);?></th>
              <th> <a href="index.php?do=entregar&livro=<?=$l->ID_Livro?>"<button class="btn btn-primary"> Entregar </button></a> </th>
            </tr>
          <?php } } }?>
        </tbody>
    </table>

  </div>
</div>