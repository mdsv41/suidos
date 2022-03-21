<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019-03
 */
?>
<script type='text/javascript'>
    function annuler() {
        document.location.replace('./attente.php');
    }
    function selecvalid(clicked_id){
        document.location.replace('./valid.php?numero='+clicked_id)
    }
</script>
</body>
</html>