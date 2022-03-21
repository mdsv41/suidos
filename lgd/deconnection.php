<?php
/**
 * Created by PhpStorm.
 * User: manue
 * Date: 19/03/2019
 * Time: 09:43
 */
$_SESSION = array();
session_destroy();
header("location: ./index.php");