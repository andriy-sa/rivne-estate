<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Bootstrap 101 Template</title>

  <!-- Bootstrap -->
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/css/main.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="auth">
<div class="auth-header">

</div>
<div class="auth-content">
  <h1>Вхід</h1>
  <?php if($message) { ?>
  <div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php echo $message;?>
  </div>
  <?php } ?>
    <form action="/auth/login" method="post" accept-charset="utf-8">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Логін" name="identity" value="" id="identity">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Пароль" name="password" value="" id="password">
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox" name="remember" value="1" id="remember"> Заповнити
        </label>
      </div>
      <input type="submit" class="btn btn-warning" name="submit" value="Login">
    </form>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/assets/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>
