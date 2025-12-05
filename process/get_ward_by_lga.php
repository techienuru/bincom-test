<?php
include_once "../includes/connect.php";

$lga_id = isset($_REQUEST["lga_id"]) ? $_REQUEST["lga_id"] : null;

$result = $connect->prepare("SELECT * FROM `ward` WHERE `lga_id`=? ORDER BY ward_name ASC");
$result->bind_param("i", $lga_id);
$result->execute();
$result->store_result();
$result->bind_result($uniqueid, $ward_id, $ward_name, $lga_id, $ward_description, $entered_by_user, $date_entered, $user_ip_address);

if ($result->num_rows() == 0) {
    echo "<option value=''>!!! No ward found for selected LGA</option>";
} else {
    echo "<option value=''>--- Select Ward ---</option>";

    while ($result->fetch()) {
        echo "<option value='$uniqueid'>$ward_name</option>";
    }
}

$result->close();
