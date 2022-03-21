<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019-03
 */
if(session_status() === PHP_SESSION_NONE){session_start();}
require_once '../../app/database.php';
require_once '../../inc/connection.php';
require_once '../../inc/dev.php';
$db = new database($db_name, $db_user, $db_pass, $db_host);

if(!empty($_GET) && isset($_GET['arriveNumero'])){
  $req = "UPDATE courriers_arrive SET 
                              arriveDate = '".$_GET['arriveDate']."',
                              arriveExpediteur = '".$_GET['arriveExpediteur']."',
                              arriveType = '".$_GET['arriveType']."',
                              arriveDocument = '".$_GET['arriveDocument']."',
                              arriveCode = '".$_GET['arriveCode']."',
                              arriveObjet = '".addslashes($_GET['arriveObjet'])."',
                              arriveDossier = '".$_GET['arriveDossier']."'
                              WHERE arriveNumero = '".$_GET['arriveNumero']."'";
  $rep = $db->exec($req);
  ?>
  <script type="application/javascript">
      alert('Courrier enregistrer');
      document.location.replace('./index.php');
  </script>
  <?php
}else{
  $req = "SELECT * FROM courriers_arrive WHERE arriveId = ".$_GET['id'];
  $courrier = $db->queryOne($req);
}

include_once '../../template_header/courrierDisabled.php';
?>
<main role="main" class="container">
  <h5> Nouveau courrier arrivé </h5>
  <div class="row">
    <form action=""method="get">
      <div class="form-group">
        <p>
          <label for="arriveDate">Date arrivée :</label>
          <input id="arriveDate" type="text" class="datepicker" name="arriveDate" value="<?= $courrier->arriveDate; ?>" required>
        </p>
        <p>
          <label for="arriveNumero">Numero d'arrivé</label>
          <input id="arriveNumero" type="text" name="arriveNumero" value="<?= $courrier->arriveNumero; ?>" disabled>
          <input id="arriveNumero" type="text" name="arriveNumero" value="<?= $courrier->arriveNumero; ?>" hidden>
        </p>
        <p>
          <label for="arriveExpediteur">Expéditeur</label>
          <input id="arriveExpediteur" type="text" name="arriveExpediteur" value="<?= $courrier->arriveExpediteur; ?>" required>
        </p>
        <p>
          <label for="arriveType">Type</label>
          <select id="arriveType" name="arriveType">
            <?php
            $types = $db->query('SELECT * FROM courriers_type');
            echo '<option value="'.$courrier->arriveType.'" selected>'.$courrier->arriveType.'</option>';
            foreach ($types as $type){
                echo '<option value="'.$type->typeName.'">'.$type->typeName.'</option>';
            }
            ?>
          </select>
        </p>
        <p>
          <label for="arriveDocument">Document</label>
          <select id="arriveDocument" name="arriveDocument">
            <?php
            $docs = $db->query('SELECT * FROM courriers_document order by docId asc ');
            echo '<option value="'.$courrier->arriveDocument.'" selected>'.$courrier->arriveDocument.'</option>';
            foreach ($docs as $doc){
                echo '<option value="'.$doc->docName.'">'.$doc->docName.'</option>';
            }
            ?>
          </select>
        </p>
        <p>
          <label for="arriveCode">Code</label>
          <select id="arriveCode" name="arriveCode">
            <?php
            $codes = $db->query('SELECT * FROM courriers_code');
			echo '<option value="' . $courrier->arriveCode . '" selected>' . $courrier->arriveCode . '</option>';
            foreach ($codes as $code) {
                echo '<option value="' . $code->codeName . '">' . $code->codeName . '</option>';
            }
            ?>
          </select>
        </p>
        <p>
          <label for="arriveObjet">Objet</label>
          <input id="arriveObjet" type="text" name="arriveObjet" value="<?= stripslashes($courrier->arriveObjet); ?>">
        </p>
        <p>
          <label for="arriveDossier">Dossier</label>
          <input id="arriveDossier" type="text" name="arriveDossier" value="<?= $courrier->arriveDossier; ?>">
        </p>
        <p>
          <label for="arriveLien">Lien</label>
          <input id="arriveLien" type="text" name="arriveLien" value="<?= $courrier->arriveLien; ?>">
        </p>
        <p>
          <input type="submit" value="Enregistrer" class="btn btn-primary">
          <input type="reset" value="Quitter" onclick="document.location.replace('./index.php');" class="btn btn-danger">
        </p>
      </div>
    </form>
  </div>
<?php
include_once '../../template_footer/courrier.php';
