<?php
// login/login.php

session_start();

// === Database connection ===
$host     = '127.0.0.1';
$dbname   = 'cemetery_db';
$dbuser   = 'root';
$dbpass   = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . htmlspecialchars($e->getMessage()));
}

if (isset($_SESSION['username'])) {
    header("Location: ../admin/circle.php");
    exit;
}

$error = '';
$input_username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = trim($_POST['username'] ?? '');
    $input_password = $_POST['password'] ?? '';

    if (empty($input_username) || empty($input_password)) {
        $error = 'Please enter username and password.';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $stmt->execute([$input_username]);
        $user = $stmt->fetch();

        if ($user && $user['password'] === $input_password) {
            $_SESSION['username']  = $user['username'];
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['logged_in'] = true;
            header("Location: ../admin/circle.php");
            exit;
        } else {
            $error = 'Incorrect username or password.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login – Cemetery Management</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: system-ui, -apple-system, sans-serif;
      background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
      min-height: 100vh;
      color: #2d3748;
      display: flex;
      flex-direction: column;
    }

    .top-bar {
      padding: 1rem 1.5rem;
      display: flex;
      justify-content: flex-end;
      background: #2b6cb0;           /* Main dashboard blue */
      color: white;
      border-bottom: 1px solid #2c5282;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .btn-home {
      padding: 0.6rem 1.4rem;
      background: rgba(255,255,255,0.15);
      color: white;
      border: 1px solid rgba(255,255,255,0.3);
      border-radius: 8px;
      font-size: 0.95rem;
      font-weight: 500;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .btn-home:hover {
      background: rgba(255,255,255,0.25);
      transform: translateY(-1px);
    }

    .login-container {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
    }

    .login-card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.12);
      width: 100%;
      max-width: 420px;
      padding: 2.5rem 2rem;
      border: 1px solid #e2e8f0;
    }

    h1 {
      font-size: 2.1rem;
      font-weight: 600;
      color: #2b6cb0;
      text-align: center;
      margin-bottom: 0.6rem;
    }

    .subtitle {
      color: #4a5568;
      text-align: center;
      margin-bottom: 2rem;
      font-size: 0.98rem;
    }

    .error {
      background: #fff5f5;
      color: #c53030;
      padding: 0.9rem;
      border-radius: 8px;
      margin-bottom: 1.5rem;
      font-size: 0.95rem;
      text-align: center;
      border: 1px solid #feb2b2;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    label {
      display: block;
      margin-bottom: 0.55rem;
      font-weight: 500;
      color: #2b6cb0;
      font-size: 0.98rem;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 0.95rem 1.1rem;
      border: 1px solid #cbd5e0;
      border-radius: 8px;
      font-size: 1rem;
      background: #f7fafc;
      transition: all 0.2s;
    }

    input:focus {
      outline: none;
      border-color: #3182ce;
      box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.2);
      background: white;
    }

    .show-password {
      margin: 0.8rem 0;
      display: flex;
      align-items: center;
      gap: 0.6rem;
      font-size: 0.94rem;
      color: #4a5568;
    }

    .btn-login {
      width: 100%;
      padding: 1.05rem;
      background: #3182ce;            /* Vibrant blue for button */
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1.05rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.25s;
      margin-top: 1.2rem;
    }

    .btn-login:hover {
      background: #2b6cb0;
      transform: translateY(-1px);
    }

    .btn-login:active {
      transform: translateY(1px);
    }

    @media (max-width: 480px) {
      .login-card {
        padding: 2rem 1.6rem;
        border-radius: 10px;
      }
      h1 {
        font-size: 1.85rem;
      }
      .top-bar {
        padding: 0.9rem 1rem;
      }
    }
  </style>
</head>
<body>

  <div class="top-bar">
    <a href="../main/landing_page.php" class="btn-home">Back to Home</a>
  </div>

  <div class="login-container">
    <div class="login-card">
      <h1>Login</h1>
     

      <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input 
            type="text" 
            id="username" 
            name="username" 
            value="<?= htmlspecialchars($input_username) ?>" 
            required 
            autofocus
            autocomplete="username"
          >
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input 
            type="password" 
            id="password" 
            name="password" 
            required 
            autocomplete="current-password"
          >
        </div>

        <div class="show-password">
          <input type="checkbox" id="showpw">
          <label for="showpw">Show password</label>
        </div>

        <button type="submit" class="btn-login">Sign In</button>
      </form>
    </div>
  </div>

  <script>
    document.getElementById('showpw').addEventListener('change', function() {
      const pw = document.getElementById('password');
      pw.type = this.checked ? 'text' : 'password';
    });
  </script>

</body>
</html>