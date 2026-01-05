<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

function csrf_token() {
    return $_SESSION['csrf'];
}

function verify_csrf($token) {
    return hash_equals($_SESSION['csrf'], $token);
}
