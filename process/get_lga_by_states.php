<?php
include_once "../includes/connect.php";

$state_id = $_REQUEST["lga_id"];

$result = $connect->prepare("SELECT * FROM `lga` ORDER BY lga_name ASC WHERE `state_id` = $state_id");
$result->execute();
$result->store_result();
$result->bind_result($state_id, $state_name);

if ($result->num_rows() == 0) {
    echo "<option value=''>!!! No record Found</option>";
} else {
    echo "<option value=''>--- Select State ---</option>";

    while ($result->fetch()) {
        echo "<option value='$state_id'>$state_name</option>";
    }
}

$result->close();
