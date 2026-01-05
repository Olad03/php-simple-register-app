<?php
require 'db.php';
require 'csrf.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!verify_csrf($_POST['csrf'])) {
        die("Invalid CSRF");
    }

    $stmt = $con->prepare(
        "SELECT id, password FROM users WHERE email = ?"
    );
    $stmt->bind_param("s", $_POST['email']);
    $stmt->execute();
    $stmt->bind_result($id, $hash);
    $stmt->fetch();

    if ($id && password_verify($_POST['password'], $hash)) {
        $_SESSION['user_id'] = $id;
        header("Location: profile.php");
        exit;
    }

    echo "Invalid login";
}
?>

<form method="post">
    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">
    <input name="email" type="email" required>
    <input name="password" type="password" required>
    <button type="submit">Login</button>
</form>
