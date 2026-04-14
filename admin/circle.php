<?php
require_once 'db_connect.php';

session_start();

// If not logged in → redirect to login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../login/login.php");
    exit;
}

// Handle logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../login/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map Selection</title>
    
    <!-- External CSS -->
    <link rel="stylesheet" href="css/circles.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <span>Grave Finder</span>
            </div>

            <div class="nav-right">
                <span class="user-name">
                    Welcome, <?= htmlspecialchars($_SESSION['username'] ?? 'Player') ?>
                </span>
                <a href="?logout=true" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <header class="page-header">
            <h1>Choose a gate</h1>
        </header>

        <!-- Map Selection Grid -->
        <div class="map-grid">
            
            <!-- Map 1 -->
            <div class="map-card" onclick="goToMap1()">
                <div class="map-image">
                    <img src="https://picsum.photos/id/866/600/400" alt="Desert Canyon">
                </div>
                <div class="map-info">
                    <h3>Gate 1</h3>
                </div>
            </div>
            <!-- Map 2 -->
            <div class="map-card" onclick="goToMap2()">
                <div class="map-image">
                    <img src="https://picsum.photos/id/866/600/400" alt="Desert Canyon">
                </div>
                <div class="map-info">
                    <h3>Gate 2</h3>
                </div>
            </div>

            <!-- Map 3 -->
            <div class="map-card" onclick="goToMap3()">
                <div class="map-image">
                    <img src="https://picsum.photos/id/866/600/400" alt="Desert Canyon">
                </div>
                <div class="map-info">
                    <h3>Gate 3</h3>
                </div>
            </div>

            <!-- Map 4 -->
            <div class="map-card" onclick="goToMap4()">
                <div class="map-image">
                    <img src="https://picsum.photos/id/866/600/400" alt="Desert Canyon">
                </div>
                <div class="map-info">
                    <h3>Gate 4</h3>
                </div>
            </div>

            <!-- Map 5 - Now goes to mapv/mapv.php -->
            <div class="map-card" onclick="goToMap5()">
                <div class="map-image">
                    <img src="https://picsum.photos/id/866/600/400" alt="Desert Canyon">
                </div>
                <div class="map-info">
                    <h3>Gate 5</h3>
                </div>
            </div>

        </div>
    </div>

    <script>
        function selectMap(mapId) {
            alert(`Map ${mapId} selected! Starting match...`);
            // You can add redirection for other maps later
            // window.location.href = `game.php?map=${mapId}`;
        }

        // Special function for Map 5
        function goToMap5() {
            window.location.href = "mapv/mapv.php";
        }
         function goToMap4() {
            window.location.href = "mapiv/mapiv.php";
        }
         function goToMap3() {
            window.location.href = "mapiii/mapiii.php";
        }
         function goToMap2() {
            window.location.href = "mapii/mapii.php";
        }
         function goToMap1() {
            window.location.href = "mapi/mapi.php";
        }
        
    </script>
</body>
</html>