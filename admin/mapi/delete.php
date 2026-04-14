<?php
require_once 'db_connect.php';

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    $sql = "UPDATE mapi 
            SET plot_id      = NULL,
                floor_number = NULL,
                circle_group = NULL,
                group_code   = NULL
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo "Location assignment cleared successfully.";
        } else {
            echo "No changes made or record not found.";
        }
        
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo "Invalid ID";
}

$conn->close();
exit;
?>