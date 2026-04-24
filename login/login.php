<?php
session_start();

/*
|--------------------------------------------------------------------------
| DATABASE CONNECTION (TiDB / Docker / Render ready)
|--------------------------------------------------------------------------
*/

$host   = getenv("DB_HOST");
$port   = getenv("DB_PORT");
$dbname = getenv("DB_NAME");
$dbuser = getenv("DB_USER");
$dbpass = getenv("DB_PASS");

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

$options = [
    PDO::MYSQL_ATTR_SSL_CA => __DIR__ . "/../certs/isrgrootx1.pem",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $dbuser, $dbpass, $options);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

/*
|--------------------------------------------------------------------------
| REDIRECT IF ALREADY LOGGED IN
|--------------------------------------------------------------------------
*/

if (isset($_SESSION['username'])) {
    header("Location: ../admin/circle.php");
    exit;
}

$error = '';
$input_username = '';

/*
|--------------------------------------------------------------------------
| LOGIN PROCESS
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input_username = trim($_POST['username'] ?? '');
    $input_password = $_POST['password'] ?? '';

    if ($input_username === '' || $input_password === '') {
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
    * { margin:0; padding:0; box-sizing:border-box; }

    body {
      font-family: system-ui, sans-serif;
      background: linear-gradient(135deg,#f0f4f8,#e2e8f0);
      min-height:100vh;
      display:flex;
      flex-direction:column;
    }

    .top-bar {
      padding:1rem;
      display:flex;
      justify-content:flex-end;
      background:#2c5282;
    }

    .btn-home {
      color:#fff;
      text-decoration:none;
      padding:0.6rem 1.2rem;
      border:1px solid rgba(255,255,255,0.3);
      border-radius:8px;
    }

    .login-container {
      flex:1;
      display:flex;
      align-items:center;
      justify-content:center;
    }

    .login-card {
      background:#fff;
      padding:2rem;
      border-radius:12px;
      width:100%;
      max-width:400px;
      box-shadow:0 10px 30px rgba(0,0,0,0.1);
    }

    h1 { text-align:center; color:#2c5282; margin-bottom:1rem; }

    .error {
      background:#fff5f5;
      color:#c53030;
      padding:0.8rem;
      margin-bottom:1rem;
      border-radius:6px;
      text-align:center;
    }

    input {
      width:100%;
      padding:0.9rem;
      margin-bottom:1rem;
      border:1px solid #ccc;
      border-radius:6px;
    }

    button {
      width:100%;
      padding:1rem;
      background:#3182ce;
      color:#fff;
      border:none;
      border-radius:6px;
      cursor:pointer;
    }

    button:hover {
      background:#2b6cb0;
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

      <input 
        type="text"
        name="username"
        placeholder="Username"
        value="<?= htmlspecialchars($input_username) ?>"
        required
      >

      <input 
        type="password"
        name="password"
        placeholder="Password"
        required
      >

      <button type="submit">Sign In</button>

    </form>

  </div>
</div>

</body>
</html>