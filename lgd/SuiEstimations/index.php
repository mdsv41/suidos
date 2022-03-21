<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019-03
 */
if(session_status() === PHP_SESSION_NONE){session_start(); };
require_once '../../app/database.php';
require_once '../../inc/connection.php';
require_once '../../inc/dev.php';

include_once '../../template_header/estimation.php';
?>
<main role="main">
  <div class="row">
    <h3 class="w-100" style="text-align: center">Sui'Estimations</h3>
    <h4 class="w-100" style="text-align: center">Bientôt sur vos écran</h4>
  </div>
</main>
<?php
include_once '../../template_footer/estimation.php';