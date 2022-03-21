<div class="gestionnaire">
    <div class="container-fluid" style="border: solid 5px #C481B2;font-size: 100%">
        <label for="BT_Besoin">Besoin :</label>
        <textarea id="BT_Besoin" name="BT_Besoin" class="table-bordered gest" style="width:100%;height:64px;"><?php echo $datas->BT_Besoin ?></textarea>
        <label for="BT_Objectif">Objectifs :</label>
        <textarea id="BT_Objectif" name="BT_Objectif" class="table-bordered gest" style="width:100%;height:64px;"><?php echo $datas->BT_Objectif ?></textarea>
        <label for="BT_DetailTrvx">Détail des travaux :</label>
        <textarea id="BT_DetailTrvx" name="BT_DetailTrvx" class="table-bordered gest" style="width:100%;height:64px;"><?php echo $datas->BT_DetailTrvx ?></textarea>
        <label for="BT_ContenueMission">Contenue de la mission :</label>
        <?php
        if( empty($datas->BT_ContenueMission) ){
            ?>
            <textarea id="BT_ContenueMission" name="BT_ContenueMission" class="table-bordered gest" style="width:100%;height:192px;">les études préliminaires (EP)
les études d'avant projet (AP)
les études de projet (PRO)
l'assistance à la passation des marchés de travaux (ACT)
les études d'exécution (EXE)
la direction de l'exécution du marché de travaux (DET)
l'ordonnance, le pilotage et la coordination du chantier (OPC)
l'assistance apportée au maître de l'ouvrage lors des opérations de réception et pendant la période de garantie de parfait achèvement (AOR)</textarea>
        <?php }else{  ?>
            <textarea id="BT_ContenueMission" name="BT_ContenueMission" class="table-bordered gest" style="width:100%;height:192px;"><?php echo $datas->BT_ContenueMission ?></textarea>
        <?php } ?>
      <label for="delais">Délais d'exécution:</label>
      <input type="text" id="delais" name="delaisexecution" class="gest" value="<?php echo $datas->delaisexcution; ?>">
    </div>
</div>