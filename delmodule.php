<?php
require 'db.php';
session_start();
$mapid = $_POST['pmapid'];
//$dpin = $_POST['pdpin'];

$result = $mysqli->query("DELETE FROM minmodules WHERE mapid='$mapid'");

//echo $mysqli->affected_rows;
if ($mysqli->affected_rows != 0) {
    echo 1;
} else {
    echo 0;
}

?>

