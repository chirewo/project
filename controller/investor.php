<?php
$investor = "SELECT * FROM investors WHERE project='$p_name'";
$i_result =mysqli_query($db,$investor);
?>