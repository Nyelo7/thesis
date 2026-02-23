<?php
// add_form.php

// Get pre-selected plot from URL (passed from circle.php)
$pre_selected_plot = trim($_GET['plot'] ?? '');

// If no plot was passed, show error or fallback (optional)
if (empty($pre_selected_plot)) {
    $pre_selected_plot = 'No plot selected'; // or die("Error: No plot selected");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add New Grave Record</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background: #f5f7fa;
      margin: 0;
      padding: 30px;
      color: #333;
    }
    .container {
      max-width: 700px;
      margin: 0 auto;
      background: white;
      padding: 35px;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    h2 {
      color: #2c3e50;
      margin-bottom: 30px;
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    td {
      padding: 14px 10px;
      vertical-align: middle;
    }
    td:first-child {
      width: 180px;
      font-weight: bold;
      color: #444;
    }
    input[type="text"],
    input[type="date"],
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
      font-size: 1em;
    }
    .readonly-text {
      background: #f0f0f0;
      color: #333;
      cursor: default;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-weight: bold;
    }
    button {
      background: #27ae60;
      color: white;
      border: none;
      padding: 14px 32px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 1.1em;
      font-weight: bold;
      display: block;
      margin: 30px auto 0;
    }
    button:hover {
      background: #219653;
    }
    #age-preview {
      font-size: 1.6em;
      font-weight: bold;
      color: #27ae60;
      min-width: 60px;
      display: inline-block;
    }
    .back {
      display: block;
      margin-top: 30px;
      color: #2980b9;
      text-decoration: none;
      font-weight: bold;
      text-align: center;
    }
    .back:hover {
      text-decoration: underline;
    }
    small {
      color: #777;
    }
  </style>
</head>
<body>

<div class="container">

  <h2>Add New Grave Record</h2>

  <form action="add.php" method="post">
    <table>
      <tr>
        <td>Plot / Circle *</td>
        <td>
          <!-- Show selected plot as read-only text -->
          <div class="readonly-text"><?= htmlspecialchars($pre_selected_plot) ?></div>
          <!-- Hidden input to send the value to add.php -->
          <input type="hidden" name="group_code" value="<?= htmlspecialchars($pre_selected_plot) ?>">
        </td>
      </tr>
      <tr>
        <td>Floor (1–5) *</td>
        <td>
          <select name="floor_number" required>
            <option value="1">Floor 1</option>
            <option value="2">Floor 2</option>
            <option value="3">Floor 3</option>
            <option value="4">Floor 4</option>
            <option value="5">Floor 5</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>First name *</td>
        <td><input type="text" name="first_name" required autofocus></td>
      </tr>
      <tr>
        <td>Middle name</td>
        <td><input type="text" name="middle_name" placeholder="optional"></td>
      </tr>
      <tr>
        <td>Last name *</td>
        <td><input type="text" name="last_name" required></td>
      </tr>
      <tr>
        <td>Date of birth *</td>
        <td><input type="date" name="birth_date" required onchange="calculateAge()"></td>
      </tr>
      <tr>
        <td>Date of death *</td>
        <td><input type="date" name="death_date" required onchange="calculateAge()"></td>
      </tr>
      <tr>
        <td>Age at death</td>
        <td>
          <span id="age-preview">—</span>
          <small> (calculated automatically)</small>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          <button type="submit">Add Person</button>
        </td>
      </tr>
    </table>
  </form>

  <a href="circle.php" class="back">← Back to Map</a>

</div>

<script>
function calculateAge() {
  const birth = document.querySelector('input[name="birth_date"]').value;
  const death = document.querySelector('input[name="death_date"]').value;
  const preview = document.getElementById('age-preview');

  if (!birth || !death) {
    preview.textContent = '—';
    preview.style.color = '#777';
    return;
  }

  const birthDate = new Date(birth);
  const deathDate = new Date(death);

  if (isNaN(birthDate.getTime()) || isNaN(deathDate.getTime()) || deathDate < birthDate) {
    preview.textContent = 'Invalid';
    preview.style.color = '#e74c3c';
    return;
  }

  let age = deathDate.getFullYear() - birthDate.getFullYear();
  const m = deathDate.getMonth() - birthDate.getMonth();

  if (m < 0 || (m === 0 && deathDate.getDate() < birthDate.getDate())) {
    age--;
  }

  preview.textContent = age;
  preview.style.color = '#27ae60';
}
</script>

</body>
</html>