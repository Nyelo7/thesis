<?php
require_once 'db_connect.php';

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    $conn->query("DELETE FROM graves WHERE id = $id");
}

header("Location: circle.php");
exit;
?>