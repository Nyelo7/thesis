<?php
// plot_info.php - Shows all 5 floors + custom delete modal

require_once 'db_connect.php';

$plot = trim($_GET['plot'] ?? '');

if (!$plot || !preg_match('/^[A-C]-\d{2}$/', $plot)) {
    die("Invalid plot ID");
}

$sql = "
    SELECT id, floor_number,
           TRIM(CONCAT(first_name, ' ', COALESCE(middle_name,' '), last_name)) AS full_name,
           age_at_death, birth_date, death_date
    FROM graves 
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
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: #f8f9fa; 
            margin: 0; 
            padding: 20px; 
            color: #333; 
        }
        .container { 
            max-width: 600px; 
            margin: 0 auto; 
            background: white; 
            padding: 30px; 
            border-radius: 12px; 
            box-shadow: 0 6px 20px rgba(0,0,0,0.15); 
        }
        h1 { 
            text-align: center; 
            color: #1e40af; 
            margin-bottom: 10px; 
        }
        .subtitle { 
            text-align: center; 
            color: #555; 
            margin-bottom: 20px; 
        }
        .status {
            text-align: center;
            font-size: 1.2em;
            margin: 20px 0;
            color: #374151;
        }
        .floor-box {
            background: #f1f5f9;
            border-radius: 10px;
            padding: 18px;
            margin: 15px 0;
            border-left: 6px solid #3b82f6;
        }
        .floor-box h3 {
            margin: 0 0 10px;
            color: #1e40af;
        }
        .person {
            background: #e5e7eb;
            padding: 12px 16px;
            margin: 8px 0;
            border-radius: 6px;
        }
        .empty {
            color: #6b7280;
            font-style: italic;
            padding: 10px 0;
        }
        .actions {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            font-size: 0.9em;
        }
        .btn-edit {
            background: #3b82f6;
            color: white;
        }
        .btn-edit:hover { background: #2563eb; }
        .btn-delete {
            background: #ef4444;
            color: white;
        }
        .btn-delete:hover { background: #dc2626; }
        .add-btn-main {
            display: block;
            width: 100%;
            padding: 14px;
            background: #27ae60;
            color: white;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1em;
            margin: 30px 0;
        }
        .add-btn-main:hover { background: #219653; }
        .back {
            display: block;
            text-align: center;
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }
        .back:hover { text-decoration: underline; }
    </style>
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


                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <span class="empty">Floor <?= $i ?> – empty / available</span>
            <?php endif; ?>
        </div>
    <?php endfor; ?>

    <!-- Replace your current add button with this -->
    
    <a href="circle.php" class="back">← Back to Cemetery Map</a>
</div>



</body>
</html>