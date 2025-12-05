<?php
include_once "../includes/connect.php";

$sql = "SELECT * FROM `party` ORDER BY partyname ASC";

$stmt = $connect->prepare($sql);
// $stmt->bind_param()
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $partyid, $partyname);

if (!$stmt->num_rows() === 0) {
    echo "<option value=''>-- No record found --</option>";
} else {
    echo "<option value=''>-- Select Party --</option>";

    while ($stmt->fetch()) {
        echo "<option value='$id'>$partyname</option>";
    }
}

$stmt->close();
