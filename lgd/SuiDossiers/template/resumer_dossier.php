<?php if(session_status() == PHP_SESSION_NONE){session_start(); } ?>
<?php


error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", "on");

/**
 * Created by PhpStorm.
 * User: mdesousa
 * Date: 20/04/2018
 * Time: 15:21
 */
include_once '../inc/db.php';
echo ' Affichage donner d\'un dossier <br>';
echo '<pre>'.print_r($_SESSION, true).'</pre><br>';
echo '<pre>'.print_r($_GET, true).'</pre>';


$req = $pdo->prepare('SELECT * FROM dossier WHERE numero = :requete');
$req->execute(['requete' => $_GET['numero']]);
$datas = $req->fetch(PDO::FETCH_OBJ);

echo '<pre>'.print_r($datas,true).'</pre>';



