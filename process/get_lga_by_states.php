<?php
include_once "../includes/connect.php";

$state_id = isset($_REQUEST["state_id"]) ? $_REQUEST["state_id"] : null;

$result = $connect->prepare("SELECT * FROM `lga` WHERE `state_id`=? ORDER BY lga_name ASC");
$result->bind_param("i", $state_id);
$result->execute();
$result->store_result();
$result->bind_result($uniqueid, $lga_id, $lga_name, $state_id, $lga_description, $entered_by_user, $date_entered, $user_ip_address);

if ($result->num_rows() == 0) {
    echo "<option value=''>!!! No LGA for selected state</option>";
} else {
    echo "<option value=''>--- Select LGA ---</option>";

    while ($result->fetch()) {
        echo "<option value='$uniqueid'>$lga_name</option>";
    }
}

$result->close();
