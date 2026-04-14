<?php
// ================================================
// cdata.php - Located in /admin/ folder
// ================================================

// Correct path to db_connect.php (since cdata.php is in admin/)
require_once 'mapi/db_connect.php';

// ==================== AUTO FIX: Add is_archived column ====================
echo "<h1>🗄️ Cemetery Database Explorer</h1>";

// =====================================================================

echo "<style>
    body { font-family: Arial, sans-serif; background: #f8f9fa; margin: 20px; }
    h1 { color: #1e40af; }
    h2 { color: #2c3e50; margin-top: 35px; }
    table { border-collapse: collapse; width: 100%; margin: 15px 0; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
    th { background: #007bff; color: white; }
    tr:nth-child(even) { background: #f8f9fa; }
    .active { background: #ecfdf5; color: #166534; padding: 4px 8px; border-radius: 4px; }
    .archived { background: #fee2e2; color: #b91c1c; padding: 4px 8px; border-radius: 4px; }
</style>";

// Show all tables
$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) {
        $table = $row[0];
        
        echo "<h2>📋 Table: <b>$table</b></h2>";

        $data_sql = "SELECT * FROM `$table` LIMIT 30";
        $data_result = $conn->query($data_sql);

        if ($data_result && $data_result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
            $fields = $data_result->fetch_fields();
            foreach ($fields as $field) {
                echo "<th>" . htmlspecialchars($field->name) . "</th>";
            }
            echo "</tr>";

            while ($data = $data_result->fetch_assoc()) {
                echo "<tr>";
                foreach ($data as $key => $value) {
                    if ($key === 'is_archived') {
                        $status = ($value == 1) ? "<span class='archived'>ARCHIVED</span>" : "<span class='active'>ACTIVE</span>";
                        echo "<td>" . $status . "</td>";
                    } else {
                        echo "<td>" . htmlspecialchars($value ?? '<i>NULL</i>') . "</td>";
                    }
                }
                echo "</tr>";
            }
            echo "</table>";
            
            if ($data_result->num_rows == 30) {
                echo "<small>Showing first 30 rows only...</small><br>";
            }
        } else {
            echo "<p>No data found.</p>";
        }
    }
} else {
    echo "<p>No tables found in the database.</p>";
}

$conn->close();
?>