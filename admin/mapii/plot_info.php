<?php
// plot_info.php - Shows all 5 floors + custom delete modal

require_once 'db_connect.php';

$plot = trim($_GET['plot'] ?? '');

if (!$plot || !preg_match('/^[A-F]-\d{2}$/', $plot)) {
    die("Invalid plot ID");
}

$sql = "
    SELECT id, floor_number,
           TRIM(CONCAT(first_name, ' ', COALESCE(middle_name,' '), last_name)) AS full_name,
           age_at_death, birth_date, death_date
    FROM mapii 
    WHERE group_code = ?
    ORDER BY floor_number, id
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $plot);
$stmt->execute();
$result = $stmt->get_result();

$floors = array_fill(1, 5, []);

while ($row = $result->fetch_assoc()) {
    $floors[$row['floor_number']][] = $row;
}

$stmt->close();
$conn->close();

$total_people = 0;
foreach ($floors as $floor_people) {
    $total_people += count($floor_people);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Plot <?= htmlspecialchars($plot) ?> – All Floors</title>
    <link rel="stylesheet" href="../css/plot_info.css">
        
</head>
<body>

<div class="container">
    <h1>Plot <?= htmlspecialchars($plot) ?></h1>
    <p class="subtitle">All 5 floors (multiple people per floor allowed)</p>

    <div class="status">
        Total people: <?= $total_people ?> / 5 floors
    </div>

    <?php for ($i = 1; $i <= 5; $i++): ?>
        <div class="floor-box">
            <h3>Floor <?= $i ?></h3>

            <?php if (!empty($floors[$i])): ?>
                <?php foreach ($floors[$i] as $person): ?>
                    <div class="person">
                        <strong><?= htmlspecialchars($person['full_name']) ?></strong><br>
                        Age: <?= $person['age_at_death'] ?><br>
                        Born: <?= $person['birth_date'] ?> • Died: <?= $person['death_date'] ?>

                        <div class="actions">
                            <a href="edit.php?id=<?= $person['id'] ?>&plot=<?= urlencode($plot) ?>" class="btn btn-edit">Edit</a>
                            <button class="btn btn-delete" 
                                    onclick="showDeleteModal(<?= $person['id'] ?>, <?= $i ?>)">Archive</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <span class="empty">Floor <?= $i ?> – empty / available</span>
            <?php endif; ?>
        </div>
    <?php endfor; ?>

    <!-- Replace your current add button with this -->
    <a href="add_form.php?plot=<?= urlencode($plot) ?>" class="add-btn-main">+ Add Person to this Plot</a>
    <a href="mapii.php" class="back">← Back to Cemetery Map</a>
</div>

<!-- Include the custom delete modal from separate file -->
<?php include 'delete_modal.php'; ?>

</body>
</html>