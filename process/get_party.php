<?php
include_once "../includes/connect.php";

$result = $connect->prepare("SELECT * FROM `party` ORDER BY partyname ASC");
$result->execute();
$result->store_result();
$result->bind_result($id, $partyid, $partyname);

if ($result->num_rows() == 0) {
    echo "<option value=''>!!! No party record found</option>";
} else {
    echo "<option value=''>--- Select Party ---</option>";

    while ($result->fetch()) {
        echo "<option value='$id'>$partyname</option>";
    }
}

$result->close();
