<?php
require 'db.php';
require 'csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!verify_csrf($_POST['csrf'])) {
        die("Invalid CSRF token");
    }

    $username = trim($_POST['username']);
    $email    = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone    = trim($_POST['phone']);
    $dob      = $_POST['dob'];
    $country  = trim($_POST['country']);
    $password = $_POST['password'];

    if (!$email || strlen($password) < 8) {
        die("Invalid input");
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $con->prepare(
        "INSERT INTO users (username, email, phone, dob, country, password, trn_date)
         VALUES (?, ?, ?, ?, ?, ?, NOW())"
    );

    $stmt->bind_param("ssssss",
        $username, $email, $phone, $dob, $country, $hash
    );

    $stmt->execute();
    header("Location: login.php");
    exit;
}
?>

<form method="post">
    <input type="hidden" name="csrf" value="<?= csrf_token() ?>">

    <input name="username" required placeholder="Username">
    <input name="email" type="email" required placeholder="Email">
    <input name="phone" required placeholder="Phone">
    <input name="dob" type="date" required>
    <input name="country" required placeholder="Country">
    <input name="password" type="password" required placeholder="Password (min 8 chars)">

    <button type="submit">Register</button>
</form>
