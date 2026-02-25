<?php
// login/login.php
// Redirects to ../admin/circle.php (sibling folder)

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

// Already logged in → redirect to admin/circle.php
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

            // Go up one level (..) then into admin/
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
  <title>Login - Cemetery System</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f2f5;
      margin: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-box {
      background: white;
      padding: 2.5rem 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 380px;
    }
    h2 { text-align: center; margin-bottom: 1.8rem; color: #333; }
    .error { color: #c0392b; text-align: center; margin-bottom: 1.2rem; font-weight: bold; }
    label { display: block; margin: 0.8rem 0 0.4rem; font-weight: bold; }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 0.9rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
      font-size: 1rem;
    }
    .show-pw { margin: 0.6rem 0; display: flex; align-items: center; gap: 0.5rem; }
    button {
      width: 100%;
      padding: 0.95rem;
      background: #27ae60;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 1.05rem;
      font-weight: bold;
      cursor: pointer;
      margin-top: 1.2rem;
    }
    button:hover { background: #219653; }
  </style>
</head>
<body>

<div class="login-box">
  <h2>Login</h2>

  <?php if ($error): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="post">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" 
           value="<?= htmlspecialchars($input_username) ?>" required autofocus>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <div class="show-pw">
      <input type="checkbox" id="showpw">
      <label for="showpw">Show password</label>
    </div>

    <button type="submit">Login</button>
  </form>
</div>

<script>
  document.getElementById('showpw').addEventListener('change', function() {
    const pw = document.getElementById('password');
    pw.type = this.checked ? 'text' : 'password';
  });
</script>

</body>
</html>