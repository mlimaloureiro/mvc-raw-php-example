<div class="row-fluid">
  <div class="span12">
    <h4>Utilizadores</h4>

    <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Login</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($utilizadores as $l) { if(is_object($l)) { ?>
            <tr>
              <th><?=$l->ID_Utilizador?></th>
              <th><?=$l->nome?></th>
              <th><?=$l->login?></th>
            </tr>
          <?php } } ?>
        </tbody>
    </table>

  </div>
</div>