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
$courrier = $db->queryOne("SELECT * FROM courriers_depart WHERE departId ='".$_GET['id']."'");
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
      $annee = substr($_POST['departNumero'],1,4);
      $dossier = __DIR__.'/'.$annee;

      $numero = $_POST['departNumero'];
      $nom = $numero.'.pdf';
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
    $nom = $_POST['departNumero'];
    $destination = $_POST['departStockage'];
  }
  $req = "UPDATE courriers_depart SET 
                              departDate = '".$_POST['departDate']."',
                              departMiseSignature = '".$_POST['departMiseSignature']."',
                              departRetourSignature = '".$_POST['departRetourSignature']."',
                              departSignataire = '".$_POST['departSignataire']."',
                              departCode = '".$_POST['departCode']."',
                              departDocument = '".$_POST['departDocument']."',
                              departDestinataire = '".$_POST['departDestinataire']."',
                              departObjet = '".addslashes($_POST['departObjet'])."',
                              departDossier = '".$_POST['departDossier']."',
                              departLien = '".$nom."',
                              departStockage = '".$destination."'
                              WHERE departNumero = '".$_POST['departNumero']."'";
  $rep = $db->exec($req);
  if ($rep == true){
    ?>
    <script type="application/javascript">
      alert('Courrier modifier');
      document.location.replace('./index.php');
    </script>
    <?php
  }
}
include_once '../../template_header/courrierDisabled.php';
?>
  <main role="main" class="container">
  <h5> Modifier courrier départ </h5>
  <div class="row">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <p>
          <label for="departDate">Date départ :</label>
          <input id="departDate" type="text" class="datepicker" name="departDate" value="<?= $courrier->departDate; ?>">
        </p>
        <p>
          <label for="departMiseSignature">Date mise en signature :</label>
          <input id="departMiseSignature" type="text" class="datepicker" name="departMiseSignature" value="<?= $courrier->departMiseSignature; ?>">
        </p>
        <p>
          <label for="departRetourSignature">Date retour signature :</label>
          <input id="departRetourSignature" type="text" class="datepicker" name="departRetourSignature" value="<?= $courrier->departRetourSignature; ?>">
        </p>
        <p>
          <label for="departSignataire">Signataire :</label>
          <input id="departSignataire" type="text" name="departSignataire" value="<?= $courrier->departSignataire; ?>">
        </p>
        <p>
          <label for="departNumero">Numero départ</label>
          <input id="departNumero" type="text" value="<?= $courrier->departNumero; ?>" disabled>
          <input id="departNumero" type="text" name="departNumero" value="<?= $courrier->departNumero; ?>" hidden>
        </p>
        <p>
          <label for="departCode">Code</label>
          <select id="departCode" name="departCode">
            <option value='<?= $courrier->departCode; ?>' selected ><?= $courrier->departCode; ?></option>
            <?php
            $codes = $db->query('SELECT * FROM courriers_code');
            foreach ($codes as $code){
              ?>
              <option value='<?= $code->codeName; ?>'><?= $code->codeName; ?></option>
              <?php
            }

            ?>
          </select>
        </p>
        <p>
          <label for="departDocument">Document</label>
          <select id="departDocument" name="departDocument">
            <option value='<?= $courrier->departDocument; ?>' selected><?= $courrier->departDocument; ?></option>
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
          <input id="departDestinataire" type="text" name="departDestinataire" value="<?= $courrier->departDestinataire; ?>" required>
        </p>
        <p>
          <label for="departObjet">Objet</label>
          <input id="departObjet" type="text" name="departObjet" value="<?= stripslashes($courrier->departObjet); ?>">
        </p>
        <p>
          <label for="departDossier">Dossier</label>
          <input id="departDossier" type="text" name="departDossier" value="<?= $courrier->departDossier; ?>">
        </p>
        <p>
          <?php
          if ($courrier->departLien == "" || $courrier->departLien == null){
            ?>
            <label for="departLien">Fichier</label>
            <input id="departLien" type="file" name="departLien">
            <?php
          }else{
            ?>
            <label for="departLien">Fichier</label>
            <input id="departLien" type="text" value="<?= $courrier->departLien; ?>" disabled>
            <input id="departLien" type="text" name="departLien" value="<?= $courrier->departLien; ?>" hidden>
            <input type="text" name="departStockage" value="<?= $courrier->departStockage; ?>" hidden>
            <?php
          }
          ?>
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

