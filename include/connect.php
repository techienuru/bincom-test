<?php
$connect = new mysqli('localhost', 'root', '1234567890', 'bincom_test');

if (!$connect) {
    die("<b>Error While Connecting to Database</b>: " . $connect->errorno);
}
