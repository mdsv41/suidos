<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2019-03
 */
?>
<script type='text/javascript'>
    function MaJ($e, clicked_id){
        $lieu = './Maj-'+$e+'.php?numero='+clicked_id;
        document.location.replace($lieu)
    }
    function New($e){
        $lieu = './New-'+$e+'.php';
        document.location.replace($lieu);
    }
</script>
</body>
</html>