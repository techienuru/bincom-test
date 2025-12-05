<?php
include_once "../includes/connect.php";

$ward_id = isset($_REQUEST["ward_id"]) ? $_REQUEST["ward_id"] : null;

$result = $connect->prepare("SELECT * FROM `polling_unit` WHERE `ward_id`=? ORDER BY polling_unit_name ASC");
$result->bind_param("i", $ward_id);
$result->execute();
$result->store_result();
$result->bind_result($uniqueid, $polling_unit_id, $ward_id, $lga_id, $uniquewardid, $polling_unit_number, $polling_unit_name, $polling_unit_description, $lat, $long, $entered_by_user, $date_entered, $user_ip_address);

if ($result->num_rows() == 0) {
    echo "<option value=''>!!! No Polling Unit for selected ward</option>";
} else {
    echo "<option value=''>--- Select Polling Unit ---</option>";

    while ($result->fetch()) {
        echo "<option value='$uniqueid'>$polling_unit_name</option>";
    }
}

$result->close();
