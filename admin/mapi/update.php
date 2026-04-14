<?php
// update.php - Saves changes and ALWAYS redirects to circle.php

require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: circle.php");
    exit;
}

$id           = (int)($_POST['id'] ?? 0);
$first_name   = trim($_POST['first_name']   ?? '');
$middle_name  = trim($_POST['middle_name']  ?? '');
$last_name    = trim($_POST['last_name']    ?? '');
$birth_date   = $_POST['birth_date']        ?? '';
$death_date   = $_POST['death_date']        ?? '';

if ($id <= 0 || empty($first_name) || empty($last_name) || empty($birth_date) || empty($death_date)) {
    die("Invalid or incomplete data.");
}

if (strtotime($death_date) < strtotime($birth_date)) {
    die("Date of death cannot be earlier than date of birth.");
}

// Re-calculate age (same as add.php)
function calculateAge($birth, $death) {
    $b = new DateTime($birth);
    $d = new DateTime($death);
    $interval = $d->diff($b);
    $age = $interval->y;
    $b->add(new DateInterval("P{$age}Y"));
    if ($d < $b) $age--;
    return max(0, $age);
}

$age_at_death = calculateAge($birth_date, $death_date);

$stmt = $conn->prepare("
    UPDATE mapi
    SET first_name = ?, middle_name = ?, last_name = ?, 
        age_at_death = ?, birth_date = ?, death_date = ?
    WHERE id = ?
");
$stmt->bind_param("sssissi", $first_name, $middle_name, $last_name, $age_at_death, $birth_date, $death_date, $id);

if ($stmt->execute()) {
    // Redirect to circle.php (your map page)
    header("Location: mapi.php");
    exit;
} else {
    die("Update failed: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>