<?php
include "db.php"; // your connection file

$sql = "SELECT * FROM workers ORDER BY id ASC";
$result = $conn->query($sql);

$workers = [];

while ($row = $result->fetch_assoc()) {
    $workers[] = $row;
}

echo json_encode($workers);
?>
