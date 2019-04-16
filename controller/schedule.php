<?php
$schedule = "SELECT * FROM schedule WHERE s_owner='$username'";
$s_result =mysqli_query($db,$schedule);


// $scheduleArray = mysqli_fetch_array($s_result);
// $s_id = $scheduleArray['id'];
// $s_owner= $scheduleArray['s_owner'];
// $s_name = $scheduleArray['s_name'];
// $s_description = $scheduleArray['s_description'];
// $s_start = $scheduleArray['s_start'];
// $s_end=$scheduleArray['s_end'];



?>