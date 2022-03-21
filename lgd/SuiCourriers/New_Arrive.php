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
require_once '../../app/fpdf.php';
require_once '../../app/fpdi/autoload.php';

$db = new database($db_name, $db_user, $db_pass, $db_host);
$courrier = $db->queryOne('SELECT * FROM courriers_arrive order by arriveNumero desc');
$annee = (int)date('Y');
if (!isset($courrier)){
  $dernierNum = "";
}elseif (isset($courrier->arriveNumero)){
  $dernierNum = $courrier->arriveNumero;
}else{
  $dernierNum = "A0000-000";
}

if ((int)substr($dernierNum,1,4) <> $annee ){
  $numero = "A".date('Y')."-001";
}else{
  $numero = (int)substr($dernierNum, 6, 3);
  if ($numero < 9) {
    $numero = $numero + 1;
    $numero = "00" . $numero;
  } elseif ($numero < 99) {
    $numero = $numero + 1;
    $numero = "0" . $numero;
  } else {
    $numero = $numero + 1;
  }
  $numero = "A" . $annee . "-" . $numero;
}



if(!empty($_POST)) {
  if ($_FILES['arriveLien']['error'] == 1) {
    ?>
    <script type="application/javascript">
        alert("Le fichier est trop gros:  > 10 mo");
    </script>
    <?php

  } else if ($_FILES['arriveLien']['error'] >= 2) {
    ?>
    <script type="application/javascript">
        alert("erreur envoi fichier");
    </script>
    <?php
  } else {
    $dossier = __DIR__.'/'.$annee;
    if(!is_dir($dossier)){
      mkdir($dossier);
    }
    $arrive = $dossier."/Arrive";
    if(!is_dir($arrive)) {
      mkdir($arrive);
    }
    $depart = $dossier . '/Depart';
    if(!is_dir($depart)) {
      mkdir($depart);
    }
    $nom = $numero.".pdf";
    $destination = "./".$annee."/Arrive/" . $nom;
    $archive = $dossier.'/Arrive/'.$nom;
    $move = move_uploaded_file($_FILES["arriveLien"]["tmp_name"], $archive);

    $pdf = new \setasign\Fpdi\Fpdi();
    $pdf->AddPage();
    $pdf->setSourceFile($archive);
    for ($pageNo = 1 ; $pageNo <=$pdf ; $pageNo++){
          $tplIdx = $pdf->importPage($pageNo);
          $pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
          $pdf->SetFont('Helvetica');
          $pdf->SetTextColor(255, 0, 0);
          $pdf->SetXY(80, 10);
          $pdf->Write(0, $numero);
    }

    $pdf->Output('F',$archive);


    $req = "INSERT INTO courriers_arrive (
                              arriveDate,
                              arriveNumero,
                              arriveExpediteur,
                              arriveType,
                              arriveDocument,
                              arriveCode,
                              arriveObjet,
                              arriveDossier,
                              arriveLien,
                              arriveStockage
                              ) VALUES (
                                        '" . $_POST['arriveDate'] . "',
                                        '" . $_POST['arriveNumero'] . "',
                                        '" . $_POST['arriveExpediteur'] . "',
                                        '" . $_POST['arriveType'] . "',
                                        '" . $_POST['arriveDocument'] . "',
                                        '" . $_POST['arriveCode'] . "',
                                        '" . addslashes($_POST['arriveObjet']) . "',
                                        '" . $_POST['arriveDossier'] . "',
                                        '" . $nom . "',
                                        '" . $destination."'
                              )";
    $rep = $db->exec($req);
    if ($rep == true) {
      ?>
      <script type="application/javascript">
          alert('Courrier enregistrer');
          document.location.replace('./index.php');
      </script>
      <?php
    }
  }
}

include_once '../../template_header/courrierDisabled.php';
?>
  <main role="main" class="container">
    <h5> Nouveau courrier arrivé </h5>
    <div class="row">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <p>
            <label for="arriveDate">Date arrivée :</label>
            <input id="arriveDate" type="date" name="arriveDate" value="<?= date('Y-m-d');?>" required>
          </p>
          <p>
            <label for="arriveNumero">Numero d'arrivé</label>
            <input id="arriveNumero" type="text" name="arriveNumero" value="<?= $numero ?>" disabled>
            <input id="arriveNumero" type="text" name="arriveNumero" value="<?= $numero ?>" hidden>
          </p>
          <p>
            <label for="arriveExpediteur">Expéditeur</label>
            <input id="arriveExpediteur" type="text" name="arriveExpediteur" required>
          </p>
          <p>
            <label for="arriveType">Type</label>
            <select id="arriveType" name="arriveType">
              <?php
              $types = $db->query('SELECT * FROM courriers_type');
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
              foreach ($codes as $code){
                echo '<option value="'.$code->codeName.'">'.$code->codeName.'</option>';
              }
              ?>
            </select>
          </p>
          <p>
            <label for="arriveObjet">Objet</label>
            <input id="arriveObjet" type="text" name="arriveObjet">
          </p>
          <p>
            <label for="arriveDossier">Dossier</label>
            <input id="arriveDossier" type="text" name="arriveDossier">
          </p>
          <p>
            <label for="arriveLien">Lien</label>
            <input id="arriveLien" type="file" name="arriveLien" >
          </p>
          <p>
            <input type="submit" value="Enregistrer" class="btn btn-primary">
            <input type="reset" value="Quitter" onclick="document.location.replace('./index.php');" class="btn btn-danger">
          </p>
        </div>
      </form>
    </div>
  </main>
<?php
include_once '../../template_footer/courrier.php';
function afficheDate($a){
  if (!empty($a)){
    return $a;
  }else{
    return null;
  }
}
