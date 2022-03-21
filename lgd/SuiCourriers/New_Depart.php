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
$courrier = $db->queryOne('SELECT * FROM courriers_depart order by departNumero desc');
$annee = (int)date('Y');
if (!isset($courrier)){
  $dernierNum = "";
}elseif (isset($courrier->departNumero)){
  $dernierNum = $courrier->departNumero;
}else{
  $dernierNum = "D0000-000";
}

if ((int)substr($dernierNum,1,4) <> $annee ){
  $numero = "D".date('Y')."-001";
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
  $numero = "D" . $annee . "-" . $numero;
}

if(!empty($_POST)){
  if(!empty($_FILES)){
    if ($_FILES['departLien']['error'] > 0) {
      ?>
      <script type="application/javascript">
        alert("Erreur lors de l'envoi du fichier.");
      </script>
      <?php
    }else if ($_FILES['departLien']['size'] > 10000000){
      ?>
      <script type="application/javascript">
        alert("Le fichier est trop gros");
      </script>
      <?php
    }else{
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
      $destination = "./".$annee."/Depart/" . $nom;
      $archive = $dossier."/Depart/".$nom;
      $move = move_uploaded_file($_FILES["departLien"]["tmp_name"], $archive);

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
    }
  }else{
    $nom = "";
    $destination = "";
  }
  $req = "INSERT INTO courriers_depart (
                              departDate,
                              departMiseSignature,
                              departRetourSignature,
                              departSignataire,
                              departNumero,
                              departCode,
                              departDocument,
                              departDestinataire,
                              departObjet,
                              departDossier,
                              departLien,
                              departStockage
                              ) VALUES (
                                        '".afficheDate($_POST['departDate'])."',
                                        '".afficheDate($_POST['departMiseSignature'])."',
                                        '".afficheDate($_POST['departRetourSignature'])."',
                                        '".$_POST['departSignataire']."',
                                        '".$_POST['departNumero']."',
                                        '".$_POST['departCode']."',
                                        '".$_POST['departDocument']."',
                                        '".$_POST['departDestinataire']."',
                                        '".addslashes($_POST['departObjet'])."',
                                        '".$_POST['departDossier']."',
                                        '" . $nom . "',
                                        '" . $destination."'
                              )";
  $rep = $db->exec($req);
  if ($rep == true){
    ?>
    <script type="application/javascript">
      alert('Courrier enregistrer');
      document.location.replace('./index.php');
    </script>
    <?php
  }
}

include_once '../../template_header/courrierDisabled.php';
?>
  <main role="main" class="container">
    <h5> Nouveau courrier départ </h5>
    <div class="row">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <p>
            <label for="departDate">Date départ :</label>
            <input id="departDate" type="date" name="departDate">
          </p>
          <p>
            <label for="departMiseSignature">Date mise en signature :</label>
            <input id="departMiseSignature" type="date" name="departMiseSignature">
          </p>
          <p>
            <label for="departRetourSignature">Date retour signature :</label>
            <input id="departRetourSignature" type="date" name="departRetourSignature">
          </p>
          <p>
            <label for="departSignataire">Signataire :</label>
            <input id="departSignataire" type="text" name="departSignataire">
          </p>
          <p>
            <label for="departNumero">Numero départ</label>
            <input id="departNumero" type="text" value="<?= $numero ?>" disabled>
            <input id="departNumero" type="text" name="departNumero" value="<?= $numero ?>" hidden>
          </p>
          <p>
            <label for="departCode">Code</label>
            <select id="departCode" name="departCode">
              <?php
              $codes = $db->query('SELECT * FROM courriers_code');
              foreach ($codes as $code){
                echo '<option value="'.$code->codeName.'">'.$code->codeName.'</option>';
              }
              ?>
            </select>
          </p>
          <p>
            <label for="departDocument">Document</label>
            <select id="departDocument" name="departDocument">
              <?php
              $docs = $db->query('SELECT * FROM courriers_document order by docId asc ');
              foreach ($docs as $doc){
                echo '<option value="'.$doc->docName.'">'.$doc->docName.'</option>';
              }
              ?>
            </select>
          </p>
          <p>
            <label for="departDestinataire">Destinataire</label>
            <input id="departDestinataire" type="text" name="departDestinataire" required>
          </p>
          <p>
            <label for="departObjet">Objet</label>
            <input id="departObjet" type="text" name="departObjet">
          </p>
          <p>
            <label for="departDossier">Dossier</label>
            <input id="departDossier" type="text" name="departDossier">
          </p>
          <p>
            <label for="departLien">Fichier</label>
            <input id="departLien" type="file" name="departLien">
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