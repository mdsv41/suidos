<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019-03
 */
?>
<script type='text/javascript'>
    function courrierDepart(){
        document.location.replace('./New_Depart.php')
    }
    function courrierArrive(){
        document.location.replace('./New_Arrive.php')
    }
    function modifDepart(clicked_id) {
        document.location.replace('./Edit_Depart.php?id='+clicked_id)
    }
    function modifArrive(clicked_id) {
        document.location.replace('./Edit_Arrive.php?id='+clicked_id)
    }
</script>
</body>
</html>
