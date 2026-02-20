<?php
// index.php - Main list of grave records + link to add form
require_once 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grave Records - Cemetery Management</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        h1, h2 {
            color: #2c3e50;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .add-btn {
            display: inline-block;
            background: #27ae60;
            color: white;
            padding: 12px 28px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 1.1em;
            font-weight: bold;
            transition: background 0.2s;
        }
        .add-btn:hover {
            background: #219653;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .actions a {
            margin-right: 14px;
            text-decoration: none;
            font-weight: bold;
        }
        .edit {
            color: #34495e;
        }
        .delete {
            color: #c0392b;
        }
        .no-records {
            text-align: center;
            padding: 60px 0;
            color: #777;
            font-size: 1.2em;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <h1>Grave Records</h1>
        <a href="add_form.php" class="add-btn">+ Add New Record</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Age</th>
                <th>Date of Birth</th>
                <th>Date of Death</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result = $conn->query("
            SELECT id, 
                   first_name, 
                   middle_name, 
                   last_name, 
                   age_at_death, 
                   birth_date, 
                   death_date 
            FROM graves 
            ORDER BY id DESC
        ");

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Build full name safely
                $full_name = trim(
                    $row['first_name'] . ' ' .
                    ($row['middle_name'] ? $row['middle_name'] . ' ' : '') .
                    $row['last_name']
                );

                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . htmlspecialchars($full_name) . "</td>";
                echo "<td>" . $row['age_at_death'] . "</td>";
                echo "<td>" . $row['birth_date'] . "</td>";
                echo "<td>" . $row['death_date'] . "</td>";
                echo "<td class='actions'>";
                echo "<a class='edit' href='edit.php?id=" . $row['id'] . "'>Edit</a>";
                echo "<a class='delete' href='delete.php?id=" . $row['id'] . "' ";
                echo "onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='no-records'>No grave records found yet.</td></tr>";
        }

        $result->free();
        ?>
        </tbody>
    </table>

</div>

</body>
</html>

<?php
$conn->close();
?>