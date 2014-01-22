<html lang="pt"><head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="./css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="./css/bootstrap-responsive.css" rel="stylesheet">
</head>

  <body style="">

    <div class="container">

      <form class="form-signin" action="login.php?do=login" method="POST">
        <h2 class="form-signin-heading">Autenticação</h2>
        <input type="text" name="login" class="input-block-level" placeholder="Utilizador">
        <input type="password" name="password" class="input-block-level" placeholder="Password">
        
        <button class="btn btn-large btn-primary" type="submit">Login</button>
      </form>

      <form class="form-signin" action="login.php?do=registar" method="POST">
        <h2 class="form-signin-heading">Registo</h2>
        <input type="text" name="nome" class="input-block-level" placeholder="Nome">
        <input type="text" name="login"class="input-block-level" placeholder="Login">
        <input type="password" name="password" class="input-block-level" placeholder="Password">
        
        <button class="btn btn-large btn-primary" type="submit">Registar</button>
      </form>

    </div> <!-- /container -->
  
</body>
</html>