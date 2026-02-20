<?php
// add.php

require_once 'db_connect.php';

function calculateAge($birth, $death) {
    $b = new DateTime($birth);
    $d = new DateTime($death);
    $interval = $d->diff($b);
    $age = $interval->y;

    // Adjust if birthday hasn't occurred in death year
    $b->add(new DateInterval("P{$age}Y"));
    if ($d < $b) {
        $age--;
    }
    return max(0, $age);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $group_code   = trim($_POST['group_code']   ?? '');
    $floor_number = (int)($_POST['floor_number'] ?? 0);
    $first_name   = trim($_POST['first_name']   ?? '');
    $middle_name  = trim($_POST['middle_name']  ?? '');
    $last_name    = trim($_POST['last_name']    ?? '');
    $birth_date   = $_POST['birth_date']        ?? '';
    $death_date   = $_POST['death_date']        ?? '';

    // Basic validation
    if (empty($group_code) || $floor_number < 1 || $floor_number > 5 ||
        empty($first_name) || empty($last_name) ||
        empty($birth_date) || empty($death_date)) {
        die("Required fields are missing or invalid.");
    }

    if (strtotime($death_date) < strtotime($birth_date)) {
        die("Date of death cannot be earlier than date of birth.");
    }

    $age_at_death = calculateAge($birth_date, $death_date);

    // Insert into database
    $stmt = $conn->prepare("
        INSERT INTO graves 
        (group_code, floor_number, first_name, middle_name, last_name, age_at_death, birth_date, death_date)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("sisssiss", 
        $group_code, 
        $floor_number, 
        $first_name, 
        $middle_name, 
        $last_name, 
        $age_at_death, 
        $birth_date, 
        $death_date
    );

    if ($stmt->execute()) {
        // Success - redirect to map
        header("Location: circle.php");
        exit;
    } else {
        die("Database error: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>