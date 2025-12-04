<?php
$connect = new mysqli('localhost', 'root', '1234567890', 'bincom_test');
// $connect = new mysqli('sql105.infinityfree.com', 'if0_34855099', '144706062002', 'if0_34855099_bincom_test');

if (!$connect) {
    die("<b>Error While Connecting to Database</b>: " . $connect->errorno);
}
