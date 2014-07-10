<script type="text/javascript" src="jquery-1.3.2.min.js"></script>
<SCRIPT TYPE="text/javascript">
alert("lol");
</SCRIPT>
<?php
echo $_POST['datos_a_enviar'];
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=ficheroExcel.xls");
header("Pragma: no-cache");
header("Expires: 0");


?>