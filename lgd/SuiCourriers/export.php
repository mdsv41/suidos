<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019/02
 */
require '../../app/HZip.php';
require '../../inc/dev.php';
$annee = $_POST['annee'];
$depart = "/home/atd41/www/html/lgd/suiCourriers/".$annee.'/Depart/';
$arrive = "/home/atd41/www/html/lgd/suiCourriers/".$annee.'/Arrive/';
$dirArchive = "/home/atd41/www/html/lgd/suiCourriers/".$annee.'/';
$nomArchive = "/home/atd41/www/html/lgd/suiCourriers/".$annee.'.zip';

HZip::zipDir($depart, $arrive, $nomArchive);

header('Content-type: application/zip'); // on indique que c'est une archive
header('Content-Transfer-Encoding: fichier'); // transfert en binaire (fichier)
header('Content-Disposition: attachment; filename='.$annee.'".zip"'); // nom de l'archive
header('Content-Length: '.filesize($annee.'.zip')); // taille de l'archive
header('Pragma: no-cache');
header('Expires: 0');
header("location:".$annee.".zip"); // redirection vers le téléchargement de l'archive
