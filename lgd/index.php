<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019-03
 */
require_once '../app/database.php';
require_once '../inc/connection.php';
require_once '../inc/dev.php';

$maintenance = '';
$file_mode = 'maintenance.html';
if(file_exists($file_mode)) {
    $maintenance = "1";
}


if ($maintenance == "1"){
?>
<script type="text/javascript">location.href="./maintenance.html";</script>
<?php
};


if (!empty($_POST) || isset($_SESSION)) {
  if(isset($_SESSION)){
    ?>
    <script>document.location.replace('./SuiDossiers/index.php')</script>
    <?php
  }else{
    if(session_status() === PHP_SESSION_NONE){session_start(); };
    $db = new database($db_name, $db_user, $db_pass, $db_host);
    $datas = $db->query('SELECT * FROM users ');
    foreach ($datas as $data) {
      if ($_POST['login'] === $data->username && $_POST['password'] === $data->password) {
        $_SESSION['name'] = $data->nom;
        $_SESSION['initial'] = $data->initial;
        $_SESSION['level'] = $data->accreditation;
        $_SESSION['mail'] = $data->mail;
        $_SESSION['user'] = $data->username;
        ?>
        <script>document.location.replace('./SuiDossiers/index.php')</script>
        <?php
      }
    }
  }

}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.5">
  <title>SuiGestion</title>
  <!-- Bootstrap core CSS -->
  <link href="./css/bootstrap.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="./css/atd.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" style="color: white;">ATD 41</a>
  <div class="collapse navbar-collapse" >
  </div>
  <div class="my-2 my-lg-0">
	<ul class="navbar-nav mr-auto">
		<li class="nav-item">
			<a class="nav-link active disable">V:1904</a>
		</li>
	</ul>
  </div>
</nav>
<main role="main" class="container" style="text-align: center; width: auto; margin-top: 100px">
  <div class="row">
    <div class="w-100">&nbsp;</div>
    <div class="col-sm"></div>
    <div class="col-sm">
      <form class="form-signin" method="post" action="">
        <img src="./img/logo.svg" alt="Connection SuiGestion" height="116">
        <h1>Sui'Gestion</h1>
        <label for="inputLogin" class="sr-only">Identifaint</label>
        <input type="text" id="inputLogin" class="form-control" placeholder="Identifiant" name="login" required autofocus>
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" name="password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
        <p class="mt-5 mb-3 text-muted"><a href="http://www.desousa.info" target="_blank">&copy; desousa.info 2019</a></p>
      </form>
    </div>
    <div class="col-sm"></div>
  </div>
</main>
</body>
</html>