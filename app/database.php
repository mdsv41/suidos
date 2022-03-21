<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019/02
 */

class database
{

  private $db_name;
  private $db_user;
  private $db_pass;
  private $db_host;
  private $pdo;

  /**
   * @param $db_name
   * @param $db_user
   * @param $db_pass
   * @param $db_host
   */
  public function __construct ($db_name, $db_user, $db_pass, $db_host)
  {
    $this->db_name = $db_name;
    $this->db_user = $db_user;
    $this->db_pass = $db_pass;
    $this->db_host = $db_host;
  }

  /**
   * initialisation de PDO
   * @return PDO
   */
  private function getPDO()
  {
    if($this->pdo === null){
      $pdo = new PDO("mysql:host=".$this->db_host.";dbname=".$this->db_name, $this->db_user, $this->db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->pdo = $pdo;
    }
    return $this->pdo;
  }

  /**
   * fonction permettant de lancer une requette
   * @param $requette
   * @return array
   */
  public function query($requette){
    $req = $this->getPDO()->query($requette);
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    return $data;
  }
  public function queryOne($requette){
    $req = $this->getPDO()->query($requette);
    $data = $req->fetch(PDO::FETCH_OBJ);
    return $data;
  }

  public function exec($requette){
    $data = $this->getPDO()->exec($requette);
    return $data;
  }

  public function prepare($requette, $donnees){
      $data = $this->getPDO()->prepare($requette);
      $data->execute($donnees);
      return $data;
  }

  public function execute($requete){
    $data = $this->getPDO()->prepare($requete);
    $data->execute();
    return;
  }
}

