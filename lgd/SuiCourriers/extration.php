<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019/02
 */
?>
<div style="display: flex" class="col-lg-12">
  <div style="text-align: center" class="col-lg-10"><h5>Extraction</h5></div>
</div>
<div class="admin">
  <form action="./suiCourriers/export.php" method="post">
    <label for="annee">Année</label>
    <input id="annee" type="number" name="annee" value="<?= date('Y');?>" required>
    <input type="submit" class="btn btn-primary" value="Exporter">
  </form>
</div>
