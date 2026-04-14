<?php
// add.php

require_once 'db_connect.php';

function calculateAge($birth, $death) {
    $b = new DateTime($birth);
    $d = new DateTime($death);
    $interval = $d->diff($b);
    $age = $interval->y;
    $b->add(new DateInterval("P{$age}Y"));
    if ($d < $b) $age--;
    return max(0, $age);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $group_code      = trim($_POST['group_code'] ?? '');
    $floor_number    = (int)($_POST['floor_number'] ?? 0);
    $contract_start  = $_POST['contract_start'] ?? '';
    $contract_end    = $_POST['contract_end'] ?? '';
    $first_name      = trim($_POST['first_name'] ?? '');
    $middle_name     = trim($_POST['middle_name'] ?? '');
    $last_name       = trim($_POST['last_name'] ?? '');
    $birth_date      = $_POST['birth_date'] ?? '';
    $death_date      = $_POST['death_date'] ?? '';

    // Validation
    if (empty($group_code) || $floor_number < 1 || $floor_number > 5 || 
        empty($first_name) || empty($last_name) || 
        empty($contract_start) || empty($contract_end) ||
        empty($birth_date) || empty($death_date)) {
        die("All required fields are missing.");
    }

    if (strtotime($contract_end) < strtotime($contract_start)) {
        die("Contract end date cannot be before start date.");
    }

    $age_at_death = calculateAge($birth_date, $death_date);

    $stmt = $conn->prepare("
        INSERT INTO mapiii 
        (group_code, floor_number, first_name, middle_name, last_name, 
         age_at_death, birth_date, death_date, contract_start, contract_end)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("sisssissss", 
        $group_code, $floor_number, $first_name, $middle_name, $last_name,
        $age_at_death, $birth_date, $death_date, $contract_start, $contract_end
    );

    if ($stmt->execute()) {
        header("Location: mapiii.php");
        exit;
    } else {
        die("Error: " . $stmt->error);
    }
}
?>