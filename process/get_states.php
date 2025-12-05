<?php
include_once "../includes/connect.php";

$result = $connect->prepare("SELECT * FROM `states` ORDER BY state_name ASC");
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
