<?php
require_once 'db_connect.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) die("Invalid ID");

$row = $conn->query("SELECT * FROM mapiii WHERE id = $id")->fetch_assoc();
if (!$row) die("Record not found");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 40px auto; padding: 20px; background: #f9f9f9; }
        label { display: block; margin: 12px 0 4px; font-weight: bold; }
        input { width: 100%; padding: 8px; box-sizing: border-box; margin-bottom: 8px; }
        button { padding: 10px 20px; background: #27ae60; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #219653; }
        #age-preview { font-size: 1.4em; font-weight: bold; color: green; }
    </style>
</head>
<body>

<h2>Edit Grave Record</h2>

<form action="update.php" method="post">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">

    <label>First name:</label>
    <input type="text" name="first_name" value="<?= htmlspecialchars($row['first_name']) ?>" required>

    <label>Middle name (optional):</label>
    <input type="text" name="middle_name" value="<?= htmlspecialchars($row['middle_name'] ?? '') ?>">

    <label>Last name:</label>
    <input type="text" name="last_name" value="<?= htmlspecialchars($row['last_name']) ?>" required>

    <label>Age at death (auto-calculated):</label>
    <div id="age-preview"><?= $row['age_at_death'] ?></div>

    <label>Date of birth:</label>
    <input type="date" name="birth_date" value="<?= $row['birth_date'] ?>" required onchange="updateAge()">

    <label>Date of death:</label>
    <input type="date" name="death_date" value="<?= $row['death_date'] ?>" required onchange="updateAge()">

    <div style="margin-top: 30px;">
        <button type="submit">Save Changes</button>
        <a href="mapiii.php" style="margin-left:20px;">Cancel</a>
    </div>
</form>

<script>
function updateAge() {
    const birth = document.querySelector('input[name="birth_date"]').value;
    const death = document.querySelector('input[name="death_date"]').value;
    const preview = document.getElementById('age-preview');

    if (!birth || !death) {
        preview.textContent = '—';
        preview.style.color = 'black';
        return;
    }

    const b = new Date(birth);
    const d = new Date(death);

    if (isNaN(b) || isNaN(d) || d < b) {
        preview.textContent = 'Invalid dates';
        preview.style.color = 'red';
        return;
    }

    let age = d.getFullYear() - b.getFullYear();
    if (d.getMonth() < b.getMonth() || (d.getMonth() === b.getMonth() && d.getDate() < b.getDate())) {
        age--;
    }

    preview.textContent = age;
    preview.style.color = 'green';
}
</script>

</body>
</html>
<?php $conn->close(); ?>